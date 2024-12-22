// selection des elements du panier
let cartIcon = document.querySelector("#cart-icon");
let cart = document.querySelector(".cart");
let closeCart = document.querySelector("#close-cart");

// ouverture et fermeture du panier
cartIcon.onclick = () =>{
    cart.classList.add("active");
}
closeCart.onclick = () =>{
    cart.classList.remove("active");
}

// evenement de chargement du DOM
if (document.readyState == "loading"){
    document.addEventListener("DOMContentLoaded", ready);
} else{
    ready();
}

// fonction ready pour les evenements lies aux boutons
function ready(){
    // selection de tous les boutons de suppression du panier et ajout d'un evenement click
    var removeCartButtons = document.getElementsByClassName("cart-remove")
    for (var i = 0; i < removeCartButtons.length; i++){
        var button = removeCartButtons[i]
        button.addEventListener("click", removeCartItem)
    }
    // selection de tous les champs de quantite et ajout d'un evenement changement de la quantite
    var quantityInputs = document.getElementsByClassName("cart-quantity")
    for (var i = 0; i < quantityInputs.length; i++){
        var input = quantityInputs[i]
        input.addEventListener("change",quantityChanged);
         
    }
    // selection de tous les boutons d'ajout au panier et ajout d'un evenement click
    var addCart = document.getElementsByClassName("add-cart");
    for (var i = 0; i < addCart.length; i++){
        var button = addCart[i];
        button.addEventListener("click", addCartClicked)
    }
    document.getElementsByClassName("btn-buy")[0].addEventListener("click",buyButtonClicked);
}

// fonction pour l'evenement de click sur le bouton d'achat
function buyButtonClicked(){
    alert("votre commande est passee")
    var cartContent = document.getElementsByClassName("cart-content")[0]
    while (cartContent.hasChildNodes()){
        cartContent.removeChild(cartContent.firstChild);
    }
    updatetotal();
}

// fonction pour l'evenement de click sur le bouton de suppression d'un produit du panier
function removeCartItem(event){
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updatetotal();
}

// fonction pour l'evenement de changement de la quantite d'un produit du panier
function quantityChanged(event){
    var input = event.target;
    if (isNaN(input.value ) || input.value <= 0 ){
        input.value = 1;
    }
    updatetotal();
}

// fonction pour l'evenement de click sur le bouton d'ajout d'un produit au panier
function addCartClicked(event){
    var button = event.target
    var shopPoducts = button.parentElement;
    var title = shopPoducts.getElementsByClassName("produit-title")[0].innerText;
    var prix = shopPoducts.getElementsByClassName("prix")[0].innerText;
    var produitImg = shopPoducts.getElementsByClassName("produit-img")[0].src;
    addProductToCart(title,prix,produitImg)
    updatetotal();

}

// fonction pour ajouter un produit au panier
function addProductToCart(title,prix,produitImg){
    // Création d'une nouvelle boîte de panier
    var cartShopBox = document.createElement("div");
    cartShopBox.classList.add("cart-box");
    // Récupération de la liste des éléments du panier et des noms des produits
    var cartItems = document.getElementsByClassName("cart-content")[0];
    var cartItemsNames = document.getElementsByClassName("cart-product-title");
    // Vérification si le produit a déjà été ajouté au panier
    for (var i = 0; i < cartItemsNames.length; i++) {
        if (cartItemsNames[i].innerText == title ){
        alert("vous avez deja ajoute cet article au panier")
        return;     
    }
    
}
// Création du contenu de la boîte de panier
var cartBoxContent = `
                        <img src="${produitImg}" class="cart-img">
                        <div class="detail-box">
                            <div class="cart-product-title">${title}</div>
                            <div class="cart-price">${prix}</div>
                            <input type="number" value="1" class="cart-quantity" >
                        </div>
                        <i class='bx bxs-trash-alt cart-remove' ></i> `;
// Ajout du contenu à la boîte de panier
cartShopBox.innerHTML = cartBoxContent;
cartItems.append(cartShopBox);
// Ajout des événements de suppression et de changement de quantité
cartShopBox.getElementsByClassName("cart-remove")[0].addEventListener("click",removeCartItem);  
cartShopBox.getElementsByClassName("cart-quantity")[0].addEventListener("change",quantityChanged);                                                
}

// Fonction pour mettre à jour le total du panier
function updatetotal (){
    var cartContent = document.getElementsByClassName("cart-content")[0]
    var cartBoxes = cartContent.getElementsByClassName("cart-box")
    // Calcul du total du panier
    var total = 0;
    for (var i = 0; i < cartBoxes.length; i++){
        var cartBox = cartBoxes[i]
        var priceElement = cartBox.getElementsByClassName("cart-price")[0];
        var quantityElement = cartBox.getElementsByClassName("cart-quantity")[0];
        var price = parseFloat(priceElement.innerText.replace("MAD",""));
        var quantity = quantityElement.value;
        total = total + price * quantity;
    }
        document.getElementsByClassName("total-price")[0].innerText =   total + " MAD";
    }
// Fonction pour remonter en haut de la page
    const btn = document.querySelector(".btn");   
    btn.addEventListener("click" , () => {

    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    })
})


/* COUNTDOWN */

const daysElement = document.querySelector('#days')
const hoursElement = document.querySelector('#hours')
const minutesElement = document.querySelector('#minutes')
const secondsElement = document.querySelector('#seconds')

window.onload = () => {
  setInterval(startTimer, 1000)
}

let staticDate = new Date('April 31, 2023 12:24:27').getTime()

const updateCountdown = (d, h, m, s) => {
  daysElement.innerText = d
  hoursElement.innerText = h
  minutesElement.innerText = m
  secondsElement.innerText = s
}

const startTimer = () => {
  let currentDate = new Date().getTime()
  let remainingDate = staticDate - currentDate

  let days = String(Math.floor(remainingDate / (1000 * 60 * 60 * 24))).padStart(
    2,
    '0'
  )
  let hours = String(
    Math.floor((remainingDate % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
  ).padStart(2, '0')
  let minutes = String(
    Math.floor((remainingDate % (1000 * 60 * 60)) / (1000 * 60))
  ).padStart(2, '0')
  let seconds = String(
    Math.floor((remainingDate % (1000 * 60)) / 1000)
  ).padStart(2, '0')

  updateCountdown(days, hours, minutes, seconds)
}


let bigImg = document.querySelector('.big-img img');
        function showImg(pic){
            bigImg.src = pic;
        }