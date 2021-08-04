( function() {
    var vm = new Vue({
      el: document.querySelector('#mount'),
      mounted: function(){
          const url = document.getElementById('kofem-media-url').value;
        console.log(url);

        setTimeout( function(){
            window.location = url;
        }, 10000);
      }
    });
  })();