class Pila {
    constructor() {
        this.arriba = -1;
        this.datosPila = new Array();
    }

    push(valor) {
        this.datosPila.push(valor);
        this.arriba = this.arriba + 1;
    }

    pop() {
        if(!this.isEmpty()){
            this.arriba = this.arriba - 1;
            return this.datosPila.pop();
        }
    }

    isEmpty(){
        return this.arriba < 0;
    }

    print() {
        if(this.size == 0)
            return;
        
        var element;
        var array = new Array();
        var res = "";

        for(var i = 0; i < this.size(); i++){
            element = this.datosPila.pop();
            res += "[" + i + "] = " + element;
            res += "\n";
            array.push(element);
        }

        for(var i = 0; i < this.size(); i++){
            element = array.pop();
            this.datosPila.push(element);
        }

        return res;
    }

    size(){
        return this.arriba + 1;
    }

    get(x){
        if(x >= (this.size() - 1))
            return this.datosPila[x];
    }

    clear(){
        for(var i = 0; i < this.size(); i++){
            this.datosPila.pop();
        }

        this.arriba = this.arriba - 1;
    }

}

class CalculadoraRPN{
    constructor(pila){
        this.pila = new Pila();
        document.addEventListener('keydown', this.eventosDeTeclado.bind(this));
    }

    inicializar(){
        this.pantalla = document.querySelector('textarea[name=\"pantalla\"]');
        this.numero = document.querySelector('input[type=text][name=\"numero\"]');
    }

    /*Borrar todo*/
    borrar(){
        this.pila.clear();
        this.numero.value="";
        this.pantalla.innerHTML = "";

    }

    /*Borrar último número introducido*/
    ce(){
        this.numero.value="";
    }

    /* Seno */
    sin(){
        if(this.pila.size() >= 1){
            this.pila.push(Math.sin(this.pila.pop()));
            this.mostrar();
        }
    }

    /*Arcseno*/
    asin(){
        if(this.pila.size() >= 1){
            this.pila.push(Math.asin(this.pila.pop()));
            this.mostrar();
        }
    }

    /* Coseno */
    cos(){
        if(this.pila.size() >= 1){
            this.pila.push(Math.cos(this.pila.pop()));
            this.mostrar();
        }
    }

    /*Arccoseno*/
    acos(){
        if(this.pila.size() >= 1){
            this.pila.push(Math.acos(this.pila.pop()));
            this.mostrar();
        }
    }

    /* Tangente */
    tan(){
        if(this.pila.size() >= 1){
            this.pila.push(Math.tan(this.pila.pop()));
            this.mostrar();
        }
    }

    /*Arcotangente*/
    atan(){
        if(this.pila.size() >= 1){
            this.pila.push(Math.atan(this.pila.pop()));
            this.mostrar();
        }
    }

    /*Números*/
    digitos(x){
        this.numero.value += Number(x);
    }

    /*Punto de los decimales*/
    decimal() {
        this.numero.value += ".";
    }

    /*Multiplicación */
    multiplicacion(){
        if(this.pila.size() >= 2){
            this.pila.push(this.pila.pop() * this.pila.pop());
            this.mostrar();
        }
    }

    /*División */
    division(){
        if(this.pila.size() >= 2){
            this.pila.push(this.pila.pop() / this.pila.pop());
            this.mostrar();
        }

    }

    /*Resta */
    resta(){
        if(this.pila.size() >= 2){
            this.pila.push(this.pila.pop() - this.pila.pop());
            this.mostrar();
        }

    }

    /*Suma */
    suma(){
        if(this.pila.size() >= 2){
            this.pila.push(this.pila.pop() + this.pila.pop());
            this.mostrar();
        }

    }

    /*Mostrar el resultado*/
    enter(){
        var aux = this.numero.value;
        this.pila.push(Number(aux));
        this.numero.value = "";
        this.mostrar();
    }

    mostrar(){
        if(!this.pila.isEmpty())
            this.pantalla.innerHTML= this.pila.print(this.pila);
    }

    eventosDeTeclado(event){
        if(event.key >= "0" && event.key <= "9")
            c.digitos(Number(event.key));
        if(event.key === ".")
            c.decimal();
        if(event.key === "s")
            c.sin();
        if(event.key === "c")
            c.cos();
        if(event.key === "t")
            c.tan();
        if(event.key === "a")
            c.asin();
        if(event.key === "z")
            c.acos();
        if(event.key === "x")
            c.atan(); 
        if (event.key === "*") 
            c.multiplicacion();
        if (event.key === "/")
            c.division();
        if (event.key === "-") 
            c.resta();
        if (event.key === "+") 
            c.suma();
        if (event.key === "b") 
            c.ce();
        if(event.key === "Delete") {
            event.preventDefault();
            c.borrar();
        }
        if(event.key === "Enter"){
            event.preventDefault();
            c.enter();
        }
    }
}   
 
pila = new Pila();
c = new CalculadoraRPN();


    
    
    