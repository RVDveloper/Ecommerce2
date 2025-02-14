window.onload = () =>{
    const cards = document.querySelectorAll('.card-main')
    const popup = document.getElementById('popup');
    const addToCartBtn = document.getElementById('add-to-cart');
    const cancelBtn = document.getElementById('cancel');

    let selectedProduct = null;
    
    cards.forEach((card, index) => {
        card.setAttribute ('data-id' , index + 1);
    });

    cards.forEach(card => {
        card.addEventListener('click', () => {
            selectedProduct = card;
            popup.style.display = 'flex';
            popup.style.justifyContent = 'center';
            popup.style.alignItems = 'center';
            popup.style.flexDirection = 'column';
        })
    })
    
    addToCartBtn.addEventListener('click', () => {
        if (selectedProduct) {
            const productData = selectedProduct.getAttribute('data-id');
            const productName = selectedProduct.querySelector('h2').textContent;

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.push({id: productData, name: productName});

            alert(`Producto ${productName} agregado al carrito`);
            popup.style.display = 'none';

        }
    });

    cancelBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });

}

