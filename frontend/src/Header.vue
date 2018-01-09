<template>

    <div class="col-lg-12 page-header">

      <div class="row">
        <div class="col-lg-12">
          <h1>
            <div class="row">
              <div class="col-lg-6">
                <i class="fa fa-users" aria-hidden="true"></i> Candidatos
              </div>

              <div class="col-lg-6 pull-right">


                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Pesquisar por nome..." v-model="searchTerm" v-on:keyup.enter="search">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" @click="search">
                          <i class="fa fa-search"></i>
                        </button>
                      </span>
                    </div>


              </div>

            </div>
          </h1>
        </div>
      </div>
    </div>

</template>

<script>

import Vue from 'vue';
import VueEvents from 'vue-events';

Vue.use(VueEvents);

export default {
  data() {
    return {
      searchTerm: null,
      records: []
    }
  },
  methods: {
    search: function() {

      this.$http.get(`person/search/?rows=15&name=` + this.searchTerm).then(
        response => {
          this.records = response.data.data;
          this.$events.fire('record-set', this.records);
        },
        error => {
          console.log(error)
        }
      )
    }
  }
}
</script>
