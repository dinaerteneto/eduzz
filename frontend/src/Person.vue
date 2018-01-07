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
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome" v-model="record.name">
              </div>

              <div class="form-group col-sm-6">
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Sobrenome" v-model="record.last_name">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-sm-6">
                <input type="text" name="date-birth" id="date-birth" class="form-control" placeholder="Data de nascimento" v-model="record.data_birth" >
              </div>

              <div class="form-group col-sm-6">
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

                      <div class="col-sm-12">
                        <input type="text" name="email" id="email" placeholder="E-Mail" class="form-control" value="">
                      </div>

                      <div class="col-sm-12">
                        <input type="text" name="cellphone" id="cellphone" placeholder="Celular" class="form-control">
                      </div>

                      <div class="col-sm-12">
                        <input type="text" name="homephone" id="homephone" placeholder="Telefone residencial" class="form-control">
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
          <button type="button" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
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
          <div class="panel-body">

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


  </section>
</template>
<script>
export default {
  data() {
    return {
      genders: [
        'Masculino', 'Feminino'
      ],
      record: {},
      records: []
    }
  },
  methods: {

    load: function() {

      this.$http.get(`person/get-all`).then(
        response => {
          console.log(response.data.data);
          this.records = response.data.data;
        },
        error => {
          console.log(error)
        }
      )
    },

    create: function() {
      this.record = {};
    },

    edit: function(record) {
        this.record = record;
        $('#myModal').modal('show');
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
              swal("Candidato excluido", {
                icon: "success",
              });
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
            var formData = this.formSerialize();
            this.$http.update(`api/person/${this.record.id}`, formData, {
                emulateHTTP: true
            }).then(
            (response)=>{
                this.formErrors = response.data.error.dev;
                if(this.formErrors === ''){
                    $('#myModal').modal('hide');
                    this.record = {};
                }
            },
            error => {
                console.log(error);
            }).finally(function(){
                this.load();
                $('#myModal').modal('hide');

            });
        } else {
            //insert
            var formData = this.formSerialize();
            this.$http.post(`api/person`,formData, {
                emulateHTTP: true
            }).then(
            (response) => {
                this.formErrors = response.data.error.dev;
                if(this.formErrors === ''){
                    $('#myModal').modal('hide');
                }
            },
            error => {
            }).finally(
            function() {
                this.load();
                $('#myModal').modal('hide');
                $.unblockUI();
            });
        }
    },

  },

  created: function() {
    this.load();
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    })
  }

}
</script>
