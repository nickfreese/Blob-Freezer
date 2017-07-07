//Freezer a base64 rendering class for loading bundles of bas64 image data.

var freezer = {
    
    settings:{
        imgElems: document.querySelectorAll('[data-freezer-name]'),
        waitForOnload: true, //renders after onload event
        response: {},
    },
    
    retrieve: function(url){
         return new Promise(function(resolve, reject) {
	       var req = new XMLHttpRequest();
            req.open('GET', url);
                req.onload = function() {
                    if (req.status == 200) {
                        resolve(req.response);
                    }
                    else {
                        reject(Error(req.statusText));
                    }
                };
                req.onerror = function() {
                    reject(Error("Network Error"));
                };
                req.send();  
        });
    },
    
    render: function(data){
        var list = this.settings.imgElems;
        console.log(data);
        data = JSON.parse(data);
        for(i=0;i<list.length;i++){
            for(key in data){
                if(list[i].getAttribute('data-freezer-name') == key){
                    list[i].src = 'data:image/jpg;base64, ' + data[key];   
                }
            }
        }    
    },
    
    run: function(url){
        _this = this;
        this.retrieve(url).then(function(response){
            if(_this.settings.waitForOnload === true && document.readyState !== 'complete'){
                _this = _this;
                _this.settings.response = response;   
               window.addEventListener('load', function(e) {
                 e = e || window.e;
                 _this.render(_this.settings.response);
                }, false);       
            }
            else{
                _this.render(response);
            }  
        });  
    },  
};