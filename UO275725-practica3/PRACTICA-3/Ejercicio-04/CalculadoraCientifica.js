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

    /*Recupera en memoria*/
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

class CalculadoraCientifica extends CalculadoraMilan {
    constructor() {
        super(); 
        this.shift = false;
        this.rad = 0;
        this.hyp = false;
    }

    suma(){
        this.pantalla.value += "+";
    }

    resta(){
        this.pantalla.value += "-";
    }

    multiplicacion(){
        this.pantalla.value += "*";
    }

    division(){
        this.pantalla.value += "/";
    }

    /* MS (Memory Storage): Almacena en memoria el número mostrado */
    ms(){
        var aux = this.pantalla.value;
        this.memoria = aux;
        document.querySelector('input[type=text][name=\"memoria"\]').value = aux;
    }

    /* Cambiar de sen/cos/tan a arcsen/arccos/artan */
    flecha(){
        this.shift = !this.shift;
        if (this.shift) { 
            document.querySelector('input[type=button][value=\"sin"\]').value = "arcsin";
            document.querySelector('input[type=button][value=\"cos"\]').value = "arccos";
            document.querySelector('input[type=button][value=\"tan"\]').value = "arctan";
        } 
        if(!this.shift) {
            document.querySelector('input[type=button][value=\"arcsin"\]').value = "sin";
            document.querySelector('input[type=button][value=\"arccos"\]').value = "cos";
            document.querySelector('input[type=button][value=\"arctan"\]').value = "tan";
        }

    }

    /*Calcula seno, cos y tangente hiperbólicos*/
    hyper(){
        this.hyp = !this.hyp;
        if (this.hyp) { 
            document.querySelector('input[type=button][value=\"sin"\]').value = "sinh";
            document.querySelector('input[type=button][value=\"cos"\]').value = "cosh";
            document.querySelector('input[type=button][value=\"tan"\]').value = "tanh";
        } 
        if(!this.hyp) {
            document.querySelector('input[type=button][value=\"sinh"\]').value = "sin";
            document.querySelector('input[type=button][value=\"cosh"\]').value = "cos";
            document.querySelector('input[type=button][value=\"tanh"\]').value = "tan";
        }
    }

    /*Cambia de grados a radianes a gradianes para calcular sen, cos, tan...*/
    deg(){
        switch(this.rad){
            case 0:
                document.querySelector('input[type=button][value=\"DEG"\]').value = "RAD";
                this.rad++;
                break;
            case 1:
                document.querySelector('input[type=button][value=\"RAD"\]').value = "GRAD";
                this.rad++;
                break;
            case 2:
                document.querySelector('input[type=button][value=\"GRAD"\]').value = "DEG";
                this.rad = 0;
                break;
        }
    }

    /* Notación científica */
    fe(){
        var aux = this.pantalla.value;
        var array = aux.split("");
        var f = false;
        for(var i = 0; i < array.length;i++){
            if(array[i]=="*")
                f = true;
        }
        // si no hay ningún operador de multiplicación
        if(!f){
            //número de dígitos del número
            var l = this.pantalla.value.length;

            //para saber por cuanto va a haber que dividir el número para que quede con solo un número al lado izquierdo del decimal
            var x = 1;
            for(var i = 0; i< l-1; i++){
                x = x * 10;
            }

            //divido
            var y = eval(this.pantalla.value +"/"+x);

            //para saber a cuanto elevar el 10 por el que vamos a multiplicar el número
            var l2 = eval(l + "-" + 1);
            this.pantalla.value = y + "*" + 10 + "**" + l2;
        }
        else{
            this.pantalla.value = aux;
        }
        
    }

    /* Número PI */
    pi(){
        this.pantalla.value += eval("Math.PI");
    }

    /* Borrar último introducido */
    delete(){
        this.pantalla.value = this.pantalla.value.substring(0, this.pantalla.value.length-1);
    }

    /* Elevar a 2 */
    potenciaDeDos(){
        this.pantalla.value = eval(this.pantalla.value + "**2");
    }

    /* Exponente */
    exponente(){
        this.pantalla.value += "*10**";
    }

    /* Módulo */
    modulo(){
        this.pantalla.value += "%";
    }

    /* Abrir paréntesis */
    abrirParentesis(){
        this.pantalla.value += "(";
    }

    /* Cerrar paréntesis */
    cerrarParentesis(){
        this.pantalla.value += ")";
    }

    /* Factorial */
    factorial(){
        var aux = 1; 
        for (var i = 1; i <= eval(this.pantalla.value); i++) {
            aux = aux * i; 
        }    

        this.pantalla.value = aux;  
    }

    /* Elevar un número a otro  */
    potenciaDeY(){
        this.pantalla.value += "**";
    }

    /* Elevar 10 a cualquier número*/
    elevar10(){
        var aux = this.pantalla.value;
        this.pantalla.value = eval("10**" + aux);
    }

    /* Logaritmo de base 10 */
    logaritmoBase10(){
        var aux = this.pantalla.value;
        this.pantalla.value = eval("Math.log10(" + aux + ")");
    }

    /* Seno y arcoseno y seno hiperbólico */
    sin(){
        var aux = this.pantalla.value;
        if(this.shift && !this.hyp){
            this.pantalla.value = eval("Math.asin(" + aux + ")");
        }
        if(!this.shift && !this.hyp){
            if(this.rad === 0){
                var x = eval(aux + "*(Math.PI/"+ 180 + ")");
                this.pantalla.value = eval("Math.sin(" + x + ")");
                
            }
            if(this.rad === 1){
                this.pantalla.value = eval("Math.sin(" + aux + ")");  
            }
            if(this.rad === 2){
                var x = eval(aux + "* Math.PI/" +200 );
                this.pantalla.value = eval("Math.sin(" + x + ")");
            }
        }
        if(!this.shift && this.hyp){
            var primero = "Math.E **" + aux;
            var segundo = "Math.E **" + "(-" + aux + ")";
            var resta = eval(primero + "-" + segundo);
            var division = eval(resta + "/2");
            this.pantalla.value=division;
        }
    }

    /* Coseno y arcoseno y coseno hiperbólico*/
    cos(){
        var aux = this.pantalla.value;
        if(this.shift && !this.hyp){
            this.pantalla.value = eval("Math.acos(" + aux + ")");
        }
        if(this.rad === 0){
            var x = eval(aux + "*(Math.PI/"+ 180 + ")");
            this.pantalla.value = eval("Math.cos(" + x + ")");              
        }
        if(this.rad === 1){
            this.pantalla.value = eval("Math.cos(" + aux + ")");
        }
        if(this.rad === 2){
            var x = eval(aux + "* Math.PI/" +200 );
            this.pantalla.value = eval("Math.cos(" + x + ")");
        }
        if(!this.shift && this.hyp){
            var primero = "Math.E **" + aux;
            var segundo = "Math.E **" + "(-" + aux + ")";
            var suma = eval(primero + "+" + segundo);
            var division = eval(suma + "/2");
            this.pantalla.value=division;
        }
    }

    /* Tangente y arcotangente y tangente hiperbólica */
    tan(){
        var aux = this.pantalla.value;
        if(this.shift && !this.hyp){
            this.pantalla.value = eval("Math.atan(" + aux + ")");
        }
        if(this.rad === 0){
            var x = eval(aux + "*(Math.PI/"+ 180 + ")");
            this.pantalla.value = eval("Math.tan(" + x + ")");
            
        }
        if(this.rad === 1){
            this.pantalla.value = eval("Math.tan(" + aux + ")");  
        }
        if(this.rad === 2){
            var x = eval(aux + "* Math.PI/" +200 );
            this.pantalla.value = eval("Math.tan(" + x + ")");
        }
        if(!this.shift && this.hyp){
            var primero = "Math.E **" + aux;
            var segundo = "Math.E **" + "(-" + aux + ")";
            var resta = eval(primero + "-" + segundo);
            var suma = eval(primero + "+" + segundo);
            var cosh = eval(resta + "/2");
            var sinh = eval(suma/2);

            this.pantalla.value=eval(sinh + "/" + cosh);
        }
    }

    mMenos(){
        super.mMenos();
        document.querySelector('input[type=text][name=\"memoria"\]').value = this.memoria;
    }

    mMas(){
        super.mMas();
        document.querySelector('input[type=text][name=\"memoria"\]').value = this.memoria;
    }

    /*Mostrar el resultado*/
    igual(){
        var x = this.pantalla.value;
        this.pantalla.value = eval(x);
    }

    /* Memory clear: elimina cualquier numero guardado en memoria*/
    mc(){
        this.memoria = 0;
        // this.pantalla.value = this.pantalla.value;
        document.querySelector('input[type=text][name=\"memoria"\]').value = "";
    }

    /* Memory recalll: recupera el numero guardado en memoria*/
    mr(){
        super.mrc();
    }

    eventosTeclado(event){
        super.eventosTeclado(event);
        if(event.key === "n")
            c.modulo();
        if(event.key === "m")
            c.pi();
        if (event.key === "x") 
            c.ms();
        if (event.key === "y") 
            c.mc();
        if (event.key === "w") 
            c.mr();
        if(event.code==="Backspace"){
            event.preventDefault();
            c.delete();
        }
        if(event.key === "e")
            c.exp();
        if(event.key === "l")
            c.log();
        if(event.key === "g")
            c.abrirParentesis();
        if(event.key === "h")
            c.cerrarParentesis();
        if(event.key === "f")
            c.factorial();
        if(event.key === "s")
            c.sin();
        if(event.key === "c")
            c.cos();
        if(event.key === "t")
            c.tan();
        if(event.key === "d")
            c.deg();
        if(event.key === "h")
            c.hyp();
        if(event.key === "j")
            c.fe();
        if(event.key === "p")
            c.potenciaDeDos();
        if(event.key === "o")
            c.potenciaDeY();
        if(event.key === "i")
            c.flecha();
        if(event.key === "t")
            c.elevar10();
    }
}

c = new CalculadoraCientifica();

   
    
    
    
