<template>
  <section>

    <div v-for="record in records" class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">{{ record.name }} {{ record.last_name }}</h3>
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

  </section>
</template>
<script>
export default {
  data() {
    return {
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
    }

  },

  created: function() {
    this.load()
  }

}
</script>
