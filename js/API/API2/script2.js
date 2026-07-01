const productsContainer = document.querySelector(".products-container")

fetch("https://www.themealdb.com/api/json/v1/1/categories.php")
  .then((response) => response.json())
  .then((data) => {
    data.categories.forEach((category) => {
      let productItem = document.createElement('div')
      productItem.classList.add("product-item")
      productItem.innerHTML = `
      <img src="${category.strCategoryThumb}" alt="">
      <p>${category.strCategory}</p>
      
      `
      productsContainer.appendChild(productItem)
    });
  })
  .catch((error) => {
    console.error("Error fetching data:", error);
  });








// // Target the grid container where categories should go
// const categoriesContainer = document.querySelector(".categories-grid");

// fetch("https://www.themealdb.com/api/json/v1/1/categories.php")
//   .then((response) => response.json())
//   .then((data) => {
//     // Clear out any hardcoded placeholder categories first
//     categoriesContainer.innerHTML = "";

//     data.categories.forEach((category) => {
//       // Create the main item wrapper
//       const categoryItem = document.createElement('div');
//       categoryItem.classList.add("category-item");
      
//       // Inject the structured HTML that matches our CSS styling
//       categoryItem.innerHTML = `
//         <div class="category-img-wrapper">
//           <img src="${category.strCategoryThumb}" alt="${category.strCategory}">
//         </div>
//         <p class="category-name">${category.strCategory}</p>
//       `;
      
//       // Append it to the main container
//       categoriesContainer.appendChild(categoryItem);
//     });
//   })
//   .catch((error) => {
//     console.error("Error fetching data:", error);
//   });