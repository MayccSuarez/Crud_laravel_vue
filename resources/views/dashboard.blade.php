@extends('app') 
@section('content')

<div id="crud" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Crud Laravel y Vue</h1>
    </div>

    <div class="col-lg-7">
        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create" 
        >
            Nueva Tarea
        </a>

        <br>
        <br>

        <table class="table table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>Tarea</th>
                <th colspan="2">&nbsp;</th>
            </tr>

            <tr v-for="task in keeps">
                <td width="10px">@{{ task.id }}</td>
                <td>@{{ task.keep }}</td>
                <td width="10px"><a href="#" class="btn btn-warning btn-sm" 
                    v-on:click="showEditModal(task)" >Edit</a></td>
                <td width="10px"><a href="#" class="btn btn-danger btn-sm" 
                    v-on:click="showConfirmationModal(task)">Delete</a></td>
            </tr>
        </table>

        <nav>
            <ul class="pagination">
                <li v-if="pagination.current_page > 1">
                    <a href="#" @click.prevent="changePage(pagination.current_page - 1)">
                        <span>Atras</span>
                    </a>
                </li>

                <li v-for="page in pagesNumber" v-bind:class="[page == isActived ? 'active': '']">
                    <a href="#" @click.prevent="changePage(page)">
                        @{{ page }}
                    </a>
                </li>

                <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" @click.prevent="changePage(pagination.current_page + 1)">
                        <span>Siguiente</span>
                    </a>
                </li>
            </ul>
        </nav>

        @include('modals.create')
        @include('modals.edit')
        @include('modals.confirm')

    </div>

    <div class="col-lg-5">
        <pre>
            @{{ $data }}
        </pre>
    </div>

</div>
@endsection