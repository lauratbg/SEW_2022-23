class CalculadoraMilan{
    constructor(){
        this.memoria = 0;
        this.operator = "";
    }

    inicializar(){
        this.pantalla = document.querySelector('input[type=text][name=\"pantalla"\]');
        document.addEventListener('keydown', this.eventosTeclado.bind(this));
    }

    /*Borrar */
    borrar(){
        this.memoria = "";
        this.pantalla.value = "";
    }

    /*Se utiliza para cuando se comete un error en el ingreso de datos pero sin eliminar todo el calculo que se encuentra realizando*/ 
    ce(){
        this.pantalla.value = "";
    }

    /*Cambiar el signo al distinto número que lo necesiten para realizar correctamente la operación */
    cambioSigno(){
        this.pantalla.value *= -1;
    }

    /*Calcula la raíz cuadrada*/
    raiz(){
        var x = this.pantalla.value;
        this.pantalla.value = eval("Math.sqrt(" + x + ")");
    }

    /*Calcula el porcentaje */
    porcentaje(){
        var array = this.pantalla.value.split("");
        var aux = 0;
        for(var i =0; i < array.length; i++){
            if(array[i]==this.operator){
                aux = i;
            }
        }

        var izq = this.pantalla.value.substring(0, aux);
        var der = this.pantalla.value.substring(aux+1, array.length);

        this.pantalla.value = array[aux];
        if(array[aux] === "+" ){
            var x = der + "*" + izq;
            var y = x + "/" + 100;
            this.pantalla.value =  eval(izq + "+" + y);
        }
        if(array[aux] === "-"){
            var x = der + "*" + izq;
            var y = x + "/" + 100;
            this.pantalla.value =  eval(izq + "-" + y);
        }
        if(array[aux] == "*" ){
            var x = izq + "*" + der;
            this.pantalla.value = eval(x + "/" + 100);

        }
        if(array[aux] == "/"){
            var x = izq + "*" + 100;
            this.pantalla.value = eval(x + "/" + der);
        }
       
    }

    /*Números*/
    digitos(x){
        this.pantalla.value += Number(x);
        this.ultimo = Number(x);
    }

    /*Punto de los decimales*/
    decimal() {
        this.pantalla.value += ".";
    }

    /*Multiplicación */
    multiplicacion(){
        var a = this.pantalla.value;
        var valor = eval(a);
        
        this.operator = "*";
        
        this.pantalla.value = valor + this.operator;
    }

    /*División */
    division(){
        var a = this.pantalla.value;
        var valor = eval(a);
        
        this.operator = "/";
        
        this.pantalla.value = valor + this.operator;

    }

    /*Resta */
    resta(){
        var a = this.pantalla.value;
        var valor = eval(a);
        
        this.operator = "-";
        
        this.pantalla.value = valor + this.operator;

    }

    /*Recupera de memoria*/
    mrc(){
        this.pantalla.value = this.memoria;
    }

    /*Suma */
    suma(){
        var a = this.pantalla.value;
        var valor = eval(a);
        
        this.operator = "+";
        
        this.pantalla.value = valor + this.operator;

    }

    /*Resta el número mostrado a otro número que se encuentre en memoria pero no muestra la resta de estos números.*/
    mMenos(){
        this.memoria = eval(this.memoria + "-" + this.pantalla.value);
    }

    /*Mostrar el resultado*/
    igual(){
        var x = this.pantalla.value;
        var array = this.pantalla.value.split("");
        var b = false;
        for(var i = 0; i < array.length;i++){
            if(array[i] === "*" || array[i] === "+" || array[i] === "/" || array[i] === "-")
                b = true;
        }
        if(b)
            this.pantalla.value = eval(x);
        else
            this.pantalla.value = eval(this.pantalla.value + this.operator + this.ultimo);

    }

    /*Suma el número mostrado a otro número que se encuentre en memoria pero no muestra la suma de estos números.*/
    mMas(){
        this.memoria = eval(this.memoria + "+" + this.pantalla.value);
    }

    /*Eventos de teclado*/
    eventosTeclado(event){
        if(event.key >= "0" && event.key <= "9")
            c.digitos(Number(event.key));
        if(event.ctrlKey && event.key === "s"){
            event.preventDefault();
            c.cambioSigno();
        }
        if(event.ctrlKey && event.key === "r"){
            event.preventDefault();
            c.raiz();
        }
        if(event.altKey && event.key === "5"){
            event.preventDefault();
            c.porcentaje();
        }
        if (event.key === "*") 
            c.multiplicacion();
        if (event.key === "/")
            c.division();
        if (event.key === "-") 
            c.resta();
        if (event.key === "z") 
            c.ce();
        if (event.ctrlKey && event.key === "m") {
            event.preventDefault();
            c.mrc();
        }
        if (event.key === "+") 
            c.suma();
        if (event.altKey && event.key === "-") {
            event.preventDefault();
            c.mMenos();
        }
        if (event.altKey && event.key === "+") {
            event.preventDefault();
            c.mMas();
        }
        if(event.key === "Delete") {
            event.preventDefault();
            c.borrar();
        }
        if(event.key === "Enter"){
            event.preventDefault();
            c.igual();
        }
    }

}

var c = new CalculadoraMilan();

