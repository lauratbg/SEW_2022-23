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

class CalculadoraEspecializada extends CalculadoraRPN{
    constructor(){
        super();
        this.kg = "";
        this.m= "";
    }

    borrar(){
        super.borrar();
        this.disableButtons();
    }
    
    enter(){
        super.enter();
        document.querySelector('input[type=button][value=\"Pollo\"]').disabled = false;
        document.querySelector('input[type=button][value=\"Tortilla\"]').disabled = false;
        document.querySelector('input[type=button][value=\"Arroz\"]').disabled = false;
        document.querySelector('input[type=button][value=\"Lentejas\"]').disabled = false;
        document.querySelector('input[type=button][value=\"Andar\"]').disabled = false;
        document.querySelector('input[type=button][value=\"Correr\"]').disabled = false;
        document.querySelector('input[type=button][value=\"Gimnasio\"]').disabled = false;
        document.querySelector('input[type=button][value=\"Pan\"]').disabled = false;
    }
    pollo(){
        const caloriasPolloPorCada100 = 239;
        if(this.pila.size() >= 1){
            var aux = this.pila.pop()*caloriasPolloPorCada100;
            this.pila.push(aux/100);
            this.pantalla.innerHTML= "[Pollo] Calorías ingeridas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    disableButtons(){
        document.querySelector('input[type=button][value=\"Pollo\"]').disabled = true;
        document.querySelector('input[type=button][value=\"Tortilla\"]').disabled = true;
        document.querySelector('input[type=button][value=\"Arroz\"]').disabled = true;
        document.querySelector('input[type=button][value=\"Lentejas\"]').disabled = true;
        document.querySelector('input[type=button][value=\"Andar\"]').disabled = true;
        document.querySelector('input[type=button][value=\"Correr\"]').disabled = true;
        document.querySelector('input[type=button][value=\"Gimnasio\"]').disabled = true;
        document.querySelector('input[type=button][value=\"Pan\"]').disabled = true;
    }

    lentejas(){
        const caloriasLentejasPorCada100 = 116;
        if(this.pila.size() >= 1){
            var aux = this.pila.pop()*caloriasLentejasPorCada100;
            this.pila.push(aux/100);
            this.pantalla.innerHTML= "[Lentejas] Calorías ingeridas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    tortilla(){
        const caloriasTortillaPorCada100 = 187;
        if(this.pila.size() >= 1){
            var aux = this.pila.pop()*caloriasTortillaPorCada100;
            this.pila.push(aux/100);
            this.pantalla.innerHTML= "[Tortilla] Calorías ingeridas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    pan(){
        const caloriasPanPorCada100 = 265;
        if(this.pila.size() >= 1){
            var aux = this.pila.pop()*caloriasPanPorCada100;
            this.pila.push(aux/100);
            this.pantalla.innerHTML= "[Pan] Calorías ingeridas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    arroz(){
        const caloriasArrozPorCada100 = 130;
        if(this.pila.size() >= 1){
            var aux = this.pila.pop()*caloriasArrozPorCada100;
            this.pila.push(aux/100);
            this.pantalla.innerHTML= "[Arroz] Calorías ingeridas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    gimnasio(){
        const caloriasGimnasioPorCadaHora = -441;
        if(this.pila.size() >= 1){
            var aux = this.pila.pop()*caloriasGimnasioPorCadaHora;
            this.pila.push(aux/60);
            this.pantalla.innerHTML= "[Gimnasio] Calorías quemadas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    correr(){
        const caloriasCorrerPorCadaHora = -600;
        if(this.pila.size() >= 1){
            var aux = (this.pila.pop()*caloriasCorrerPorCadaHora);
            this.pila.push(aux/60);
            this.pantalla.innerHTML= "[Correr] Calorías quemadas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    andar(){
        const caloriasAndarPorCadaHora = -300;
        if(this.pila.size() >= 1){
            var aux = this.pila.pop()*caloriasAndarPorCadaHora;
            this.pila.push(aux/60);
            this.pantalla.innerHTML= "[Andar] Calorías quemadas: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
        this.disableButtons();
    }

    calcular(){
        var aux = 0;
        if(this.pila.size() >= 2){
            this.pila.push(this.pila.pop() + this.pila.pop());
            this.pantalla.innerHTML= "Calorías totales: ";
            this.pantalla.innerHTML += this.pila.print(this.pila);
        }
    }
    
    imc(){
        if(this.kg != "" && this.m != ""){
            var aux = (this.m * this.m);
            var result = this.kg / aux;
            var nivel = "";
            if(result < 18.5)
                nivel = "Bajo peso";
            if(result >= 18.5 && result < 24.9)
                nivel = "Peso normal";
            if(result >= 24.9 && result < 29.9)
                nivel = "Sobrepeso";  
            if(result >= 30)
                nivel = "Obesidad";  
            this.pila.push("IMC - " + nivel);
            this.mostrar();
            this.kg = "";
            this.m = "";
            document.querySelector('input[type=button][value=\"IMC\"]').disabled = true;
        }
    }

    peso(){
        this.kg = this.pila.pop();
        this.pila.push("Peso: " + this.kg);
        this.mostrar();
        if(this.kg != "" && this.m != ""){
            document.querySelector('input[type=button][value=\"IMC\"]').disabled = false;
        }
       
    }

    altura(){
        this.m = this.pila.pop();
        this.pila.push("Altura: " + this.m);
        this.mostrar();
        if(this.kg != "" && this.m != ""){
            document.querySelector('input[type=button][value=\"IMC\"]').disabled = false;
        }
    }

    eventosDeTeclado(event){
        super.eventosDeTeclado(event);
        if(event.key === "p")
            c.pan();
        if(event.key === "r")
            c.arroz();
        if(event.key === "g")
            c.gimnasio();
        if(event.key === "l")
            c.lentejas();
        if(event.key === "h")
            c.pollo();
        if(event.key === "e")
            c.tortilla(); 
        if (event.key === 'o') 
            c.andar();
        if (event.key === 'f')
            c.correr();
        if (event.key === 'y') 
            c.calcular();
        if (event.key === 'i') 
            c.imc();
        if (event.key === 'k') 
            c.peso();
        if (event.key === 'j') 
            c.altura();
    }

}

pila = new Pila();
c = new CalculadoraEspecializada();


    
    
    