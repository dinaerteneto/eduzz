<template>
  <section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Candidato</h4>
          </div>
          <div class="modal-body">
            <form class="clearfix">

              <div class="row">
                <div class="form-group col-sm-6">
                  <label class="">Nome</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Nome" v-model="record.name">
                </div>

                <div class="form-group col-sm-6">
                  <label class="">Sobrenome</label>
                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Sobrenome" v-model="record.last_name">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-sm-6">
                  <label>Data de nascimento</label>
                  <input type="text" name="date-birth" id="date-birth" class="form-control" placeholder="dd/mm/aaaa" v-model="record.date_birth" v-mask="'99/99/9999'">
                </div>

                <div class="form-group col-sm-6">
                  <label>Sexo</label>
                  <select name="gender" class="form-control" v-model="record.gender">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                  </select>

                </div>
              </div>

              <div class="row">

                <div class="col-sm-12">
                  <h4>Contatos</h4>
                  <div>
                    <div class="form-group">

                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label>E-Mail</label>
                            <input type="text" name="email" id="email" placeholder="E-Mail" class="form-control" v-model="email.value" >
                          </div>

                          <div class="form-group col-sm-6">
                            <label>Celular</label>
                            <input type="text" name="cellphone" id="cellphone" placeholder="Celular" class="form-control" v-model="cellphone.value">
                          </div>
                        </div>


                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label>Fone residencial</label>
                            <input type="text" name="homephone" id="homephone" placeholder="Telefone residencial" class="form-control" v-model="homephone.value">
                          </div>

                          <div class="form-group col-sm-6">
                            <label>Fone comercial</label>
                            <input type="text" name="comercialphone" id="comercialphone" placeholder="Telefone comercial" class="form-control" v-model="comercialphone.value">
                          </div>
                        </div>

                    </div>

                  </div>
                </div>

              </div>

            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" @click.prevent="save()">Salvar</button>
          </div>

        </div>
      </div>
    </div>
    <!-- End of Modal -->

    <div class="row" style="margin-bottom: 20px">
      <div class="col-sm-12">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" @click.prevent="create()" >
          Incluir candidato
        </button>
      </div>
    </div>

    <div class="row">
      <div v-for="record in records" class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
              {{ record.name }} {{ record.last_name }}
              <span class="pull-right">
                <a href="javascript::void()" data-toggle="tooltip" data-placement="top" title="Alterar dados do candidato" @click.prevent="edit(record)"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="javascript::void()" data-toggle="tooltip" data-placement="top" title="Excluir o candidato" @click.prevent="remove(record)"><i class="glyphicon glyphicon-remove-sign"></i></a>
              </span>
            </h3>
          </div>
          <div class="panel-body" style="height: 120px;">

            <table class="table">
              <tr v-for="contact in record.contacts">
                <td><span class="label label-default">{{ contact.contact_type.name }}</span></td>
                <td>{{ contact.value }}</td>
                <td></td>
              </tr>
            </table>

          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <pagination :data="data" v-on:pagination-change-page="load"></pagination>
    </div>


  </section>
</template>
<script>

import Vue from 'vue';
import Pagination from 'laravel-vue-pagination';
const VueInputMask = require('vue-inputmask').default;
Vue.use(VueInputMask);

Vue.component('pagination', Pagination);

export default {
  data() {
    return {
      genders: [
        'Masculino', 'Feminino'
      ],

      email: {type: 1, value: null},
      cellphone: {type: 2, value: null},
      comercialphone: {type: 3, value: null},
      homephone: {type: 4, value: null},

      record: {},
      records: [],
      data: []
    }
  },
  methods: {

    formSerialize: function() {
      let obj = this.record;

      if(obj.date_birth.length > 0) {
        let dateBirth = obj.date_birth.split('/');
        obj.date_birth = dateBirth[2] + '-' + dateBirth[1] + '-' + dateBirth[0]
      }

      obj.contact = [
        this.email,
        this.cellphone,
        this.comercialphone,
        this.homephone
      ];
      return obj;
    },

    load: function(page) {

      if (typeof page === 'undefined') {
        page = 1;
      }

      this.$http.get(`person/get-all?page=` + page).then(
        response => {
          this.records = response.data.data;
          this.data = response.data;
        },
        error => {
          console.log(error)
        }
      )
    },

    clear: function() {
      this.email = {id: 'a', type: 1, value: null};
      this.cellphone = {id: 'b', type: 2, value: null};
      this.comercialphone = {id: 'c', type: 3, value: null};
      this.homephone = {id: 'd', type: 4, value: null};
    },

    create: function() {
      this.record = {};
      this.clear();
    },

    edit: function(record) {
        this.record = record;
        this.clear();

        this.email = this.getContact(record, 1);
        this.cellphone = this.getContact(record, 2);
        this.comercialphone = this.getContact(record, 3);
        this.homephone = this.getContact(record, 4);

        if(this.record.date_birth.indexOf('/') == -1) {
          let dateBirth = this.record.date_birth.length > 0 ? this.record.date_birth.split('-') : null;

          if(dateBirth.length > 0) {
            this.record.date_birth = dateBirth[2] +'/' + dateBirth[1] + '/' + dateBirth[0];
          }
        }

        $('#myModal').modal('show');
    },

    getContact: function(data, type_id) {
      var x = [];
      data.contacts.forEach(function(element, index) {
        if(element.contact_type_id == type_id) {
          x.push({id: element.id, type: element.contact_type_id, value: element.value});
        }
      });
      if(x.length > 0) {
        return x[0];
      }
      return {id: null, type: type_id, value: null};
    },

    remove: function(record) {

      swal({
        title: "Tem certeza?",
        text: "Excluir o candidato " + record.name + " " + record.last_name +  "?" ,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          this.$http.delete(`person/${record.id}`).then(
          (response) => {
              this.record = {};
              swal("Candidato excluido", {icon: "success"});
          },
          error => {
              console.log(error);
              }).finally(function(){
                  this.load();
              }
          );
        }
      });
    },

    save: function() {

        if(this.record.id!= null) {
            //update
            let formData = this.formSerialize();
            this.$http.put(`person/${this.record.id}`, formData, {
                emulateHTTP: true
            }).then(
            (response)=>{
              $('#myModal').modal('hide');
              swal("Candidato alterado com sucesso.", {icon: "success"});
              this.record = {};
            },
            error => {
                console.log(error);
            }).finally(function(){
                this.load();
                $('#myModal').modal('hide');
            });
        } else {
            //insert
            let formData = this.formSerialize();
            this.$http.post(`person/create`,formData, {
                emulateHTTP: true
            }).then(
            (response) => {
                $('#myModal').modal('hide');
                swal("Candidato incluído com sucesso.", {icon: "success"});
            },
            error => {
            }).finally(
            function() {
                this.load();
                $('#myModal').modal('hide');
            });

        }
    },

  },

  events: {
    'record-set' (records) {
      this.records = records;
    }
  },

  created: function() {
    this.load();
  }

}
</script>
