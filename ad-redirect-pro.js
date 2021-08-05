( function() {
    var vm = new Vue({
      el: document.querySelector('#mount'),
      data: {
          country :'',

      },
      mounted: function(){
          const url = document.getElementById('kofem-media-url').value;
          const api = 'http://ipinfo.io/json';
          fetch(api).then((response)=>{
            return response.json()
            }).then((data)=>{
              this.country = data.country;
              console.log(this.country);
              if(this.country == 'USA'){
                console.log('From USA');
            }else{
                console.log(this.country)
                setTimeout( function(){
                    window.location = url;
                }, 10000);
    
            }
            });
        // console.log(url);

        // console.log()
        
      
      }
    });
  })();