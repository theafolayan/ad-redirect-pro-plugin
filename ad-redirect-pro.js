( function() {
    var vm = new Vue({
      el: document.querySelector('#mount'),
      mounted: function(){
          const url = document.getElementById('kofem-media-url').value;
          const userAgent = window.navigator.userAgent;
          if(userAgent.includes('FacebookBot')){
            console.log('Na Facebook Bot o!');
        }else{
            setTimeout( function(){
                localStorage.setItem('kofem-visited', 'true');
                window.location = url;
            }, 10000);

        }
        
      }
    });
  })();