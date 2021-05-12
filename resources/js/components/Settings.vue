<template>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">

                <div class="card">
                    <div class="card-header d-flex justify-content-between" >
                        <h3 class="card-title mr-auto">Settings List</h3>
                        <div class="float-right">
                            <button class="btn btn-primary btn-sm" @click="openAddSetting()">
                                add Setting
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body cust-cbo">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-success" role="status" style="width:4rem;height:4rem;" v-if="loading">
                            <span class="sr-only">Loading</span>
                        </div>
                        </div>

                        <table class="table table-bordered table-sm table-hover ">

                            <thead>
                            <tr>
                                <th scope="col" style="width:60%">Key</th>
                                <th scope="col" style="width:20%">Value</th>
                                <th scope="col" style="width:10%">locked</th>
                                <th scope="col" style="width:10%">Controls</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr v-for="setting in settings.data" :key="setting.id">
                                    <td class="align-middle">
                                        {{setting.name}}
                                    </td>
                                    <td class="align-middle">{{setting.payload}}</td>
                                    <td class="align-middle text-center">
                                        <i class="fas fa-lock" style="color:red" v-if="setting.locked === 1"></i>
                                        <i class="fas fa-unlock" style="color:green" v-if="setting.locked === 0"></i>

                                        </td>
                                    <td class="align-middle">
                                        <div class="btn-group" aria-label="Controls">

                                            <button type="button" @click="editSetting(setting)" class="btn btn-info btn-sm" data-toggle="modal" data-target="create-setting">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" @click="deleteSetting(setting.id)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>

                        <!-- Modal -->
                        <div class="modal fade" id="edit-setting">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" v-if="modal=='new'">Create Setting</h4>
                                       <h4 class="modal-title" v-if="modal=='edit'">Edit Setting</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Name{{setting.activeItem}}</label>
                                                <input type="text" v-model="setting.name" class="form-control" v-if="modal=='new'" id="name" autofocus required>
                                                <input type="text" v-model="setting.name" class="form-control" v-if="modal=='edit'" id="name" autofocus required disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="group">Group</label>
                                                <input id="group" type="text" class="form-control" v-if="modal=='new'" v-model="setting.group" required>
                                                <input id="group" type="text" class="form-control" v-if="modal=='edit'" v-model="setting.group" required disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="payload">Payload</label>
                                                <input type="text" v-model="setting.payload" class="form-control" id="payload" required>
                                            </div>

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" v-model="setting.locked" id="locked">
                                                <label class="custom-control-label" for="locked">Locked?</label>
                                            </div>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button @click="addSetting()" type="button" class="btn btn-primary" v-if="modal=='new'">Add Setting</button>
                                        <button @click="updateSetting()" type="button" class="btn btn-primary" v-if="modal=='edit'">Apply changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->

                    </div>

                <div class="card-footer clearfix">
                    <pagination :data="settings" @pagination-change-page="loadSettings"></pagination>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data:function(){
            return{
                settings: {},
                setting:{
                    name:null,
                    group:null,
                    payload:null,
                    locked:null,
                },
                activeItem:null,
                modal:null,
                loading: true
            }
        },
        mounted(){
            this.loadSettings();

        },
        methods: {

            loadSettings:function(page=1){
                axios.get("/api/settings?page="+page)
                .then((response) =>{
                    this.settings = response.data;

                })
                .catch(function (error){
                    toastr.error(error);

                })
                .finally(()=>{
                    this.loading = false;

                });
            },
            openAddSetting: function(){
                this.setting = "";
                this.modal = 'new';
                $('#edit-setting').modal('show');



            },
            addSetting: function(){
                axios.post('/api/settings/store', this.setting)
                .then(function (response) {
                    $('#edit-setting').modal('hide');
                    this.loadSettings();
                })
                .catch(function (error) {
                    console.log(error);
                });


            },
            updateSetting: function(){


                axios.put('/api/settings/update/' + this.setting.id, this.setting)
                .then(function (response) {

                    $('#edit-setting').modal('hide');
                    loadSettings();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            editSetting: function(setting){
                this.modal = 'edit';
                this.setting = setting;
                this.activeItem = setting.id;

                $('#edit-setting').modal('show');
            },
            deleteSetting: function (id) {
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {


                    axios.delete('/api/settings/delete/' + id)
                    .then(response => {
                        this.loadSettings();
                        console.log(response);
                    });


                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })
            },
        }
    }
</script>
