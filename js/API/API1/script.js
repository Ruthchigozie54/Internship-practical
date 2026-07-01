

const productsContainer = document.querySelector(".products-container")

fetch('https://dummyjson.com/products')
  .then(response => response.json())
  .then(data => {
    data.products.forEach((product) => {
      const productItem = document.createElement('div')
      productItem.classList.add('product-items')
      productItem.innerHTML = `
        <img style="width: 80%" src="${product.thumbnail}" alt="">
        <p class="category">${product.category}</p>
        <p>${product.description}</p>
        <p style="margin-top: 10px">${product.price}</p>
      `
      productsContainer.appendChild(productItem)
    })
  })