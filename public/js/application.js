// common way to initialize jQuery
$(function() {
    $("#buscadorajax").on("click", function(e){
        e.preventDefault();
        $("#resultterminos").load("/wiki/termino/buscarajax/" + $(this).siblings("[name|='busqueda']").val());
    });
    $("#buscadorajaxjson").on("click", function(e){
        e.preventDefault();
        var urlDestino = "/wiki/termino/buscarajaxjson/" + $(this).siblings("[name|='busqueda']").val();
        $.getJSON(urlDestino, function(elems){
           console.log(elems);
           var ul = $("#sortable");
           ul.empty();
           elems.forEach(function(elem){
                //console.log(elem);
                $("<li>")
                .text(elem.titulo)
                .addClass("ordenable")
                .prepend('<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>')
                .appendTo(ul);
           });
           ul.sortable({
                placeholder: "ui-state-highlight",
                cursor: "move"
            });
           ul.disableSelection();
           
           //llamo a otra función que haga otras cosas con el mismo json
           cargaElementosEnPlantillaHandlebars(elems);
        });
    });
    function cargaElementosEnPlantillaHandlebars(elems){
        console.log("cargando en plantilla");
        var stemplate = $("#template").html();
        console.log("cargando en plantilla", stemplate);
        var tmpl = Handlebars.compile(stemplate);
        var ctx = {};
        ctx.terminos = elems;
        var html = tmpl(ctx);
        console.log("res ejec plantilla: ", html)
        $("body").append(html);
        cargaElementosEnPlantillaHandlebars2(elems);
    }
    function cargaElementosEnPlantillaHandlebars2(elems){
        console.log("cargando en plantilla");
        var stemplate = $("#template2").html();
        console.log("cargando en plantilla", stemplate);
        var tmpl = Handlebars.compile(stemplate);
        var ctx = {};
        ctx.terminos = elems;
        var html = tmpl(ctx);
        console.log("res ejec plantilla: ", html)
        $("body").append(html);
        $("#intercambiador").dwdinanews();
    }
    
    
    // scripts para categorias
    var capaCateg = $("#listadocategorias");
    if(capaCateg.length==1){
        //estoy en la sección de categorias
        
        //cargo las categorias que me vienen de un json
        console.log("aplicanto cats");
        var urlDestino = "/wiki/categorias/vertodas";
        $.getJSON(urlDestino, function(elems){
            var stemplate = $("#tmpl_listacategoria").html();
            var tmpl = Handlebars.compile(stemplate);
            var ctx = {};
            ctx.categorias = elems;
            var html = tmpl(ctx);
            capaCateg.append(html);
            
            
            //enlace ajax para cargar los términos de una categoria
            capaCateg.find("a.enlaceexpandir").on("click", function(e){
                e.preventDefault();
                var enlace = $(this);
                console.log(enlace.attr("href"));
                $.getJSON(enlace.attr("href"), function(terminosCat){
                    var destino = $("#detallecategoria");
                    console.log(terminosCat);
                    if(terminosCat.length==0){
                        destino.html("No tengo ningún término de esta categoría");
                    }else{
                        var stemplate = $("#tmpl_listaterminos").html();
                        var tmpl = Handlebars.compile(stemplate);
                        var ctx = {};
                        ctx.terminos = terminosCat;
                        var html = tmpl(ctx);
                        destino.html(html);
                    }
                });  
            });
            
            //enlace ajax para editar una categoria
            capaCateg.find("a.enlaceeditar").on("click", function(e){
                e.preventDefault();
                var enlace = $(this);
                console.log(enlace.attr("href"));
                $.getJSON(enlace.attr("href"), function(cat){
                    var destino = $("#editarcategoria");
                    console.log(cat);
                    var stemplate = $("#tmpl_editacategoria").html();
                    var tmpl = Handlebars.compile(stemplate);
                    var html = tmpl(cat);
                    destino.html(html);
                    
                    /*
                     *
                     *Esto es una alternativa si quisiera hacer ajax con ese formulario de edicion
                     *
                    //voy a aplicar el comportamiento ajax a este formulario
                    destino.find("form").on("submit", function(e){
                       e.preventDefault();
                       var form = $(this);
                       $.post(form.attr("action"), form.serialize(), function(res){
                            form.find(".muestraresultado").text(res);
                       });
                    });
                    */
                });
            });
        });
        
        
    }
});
