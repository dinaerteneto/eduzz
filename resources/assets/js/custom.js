Custom = {
  init: function() {
    Custom.getAll();
  },

  getAll: function() {
    axios.get('http://eduzz.api/api/v1/person/get-all', {

    })
    .then(function (response) {
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
  }

}
$(document).ready(function() {
  Custom.init();
})
