
var app = new Vue({

    el: '#crud',

    created: function () {
        this.getTasks();
    },

    data: {

        keeps: [],
        newTask: '',
        errors: [],
        task: { 'id': '', 'keep': '' },
        pagination: {
            'total'         : 0,
            'current_page'  : 0,
            'per_page'      : 0,
            'last_page'     : 0,
            'from'          : 0,
            'to'            : 0,
        },
        offset: 2
    },

    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },

        pagesNumber: function() {

            if (!this.pagination.total || this.pagination.last_page == 1){
                return [];
            }

            var from = this.pagination.current_page - this.offset; 
            if (from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if (to > this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    },

    methods: {

        getTasks: function (page) {
            var urlTasks = 'tasks?page=' + page;

            axios.get(urlTasks).then(response => {
                this.keeps = response.data.tasks.data;
                this.pagination = response.data.pagination;
            });
        },

        refreshTask: function (task) {
            this.task.id = task.id;
            this.task.keep = task.keep;
        },

        clearTask: function () {
            this.task.id = '';
            this.task.keep = '';
        },

        showEditModal: function (task) {
            this.refreshTask(task);
            this.errors = []; // limpiar por si hubieron errores previos
            $('#edit').modal('show');
        },

        updateTask: function (id) {
            var url = 'tasks/' + id;

            axios.put(url, {
                keep: this.task.keep
            }).then(response => {
                this.clearTask();
                this.getTasks();
                this.errors = [];
                $('#edit').modal('hide');
                toastr.info('Tarea actualizada!!!');
            }).catch(error => {
                this.errors = error.response.data;
            });
        },

        showConfirmationModal: function (task) {
            this.refreshTask(task);

            $('#confirm').modal('show');
        },

        deleteTask: function () {
            var urlTask = 'tasks/' + this.task.id;

            axios.delete(urlTask).then(response => {
                this.clearTask();
                this.getTasks();
                $('#confirm').modal('hide');
                toastr.info('Tarea eliminada!!!');
            });
        },

        createTask: function () {
            var ultCreate = 'tasks';

            axios.post(ultCreate, {
                keep: this.newTask
            }).then(response => {
                this.getTasks();
                this.newTask = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.info('Tarea creada');
            }).catch(error => {
                this.errors = error.response.data
            });
        },

        changePage: function (page){
            this.getTasks(page);            
        }

    }

});