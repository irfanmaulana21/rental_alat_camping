document.addEventListener("DOMContentLoaded", function () {

    // =====================
    // AOS INIT
    // =====================
    AOS.init({
        duration: 800,
        once: false
    });

    // =====================
    // SEARCH FUNCTION
    // =====================
    const searchInput = document.getElementById("searchInput");
    const products = document.querySelectorAll(".product-card");
    const notFound = document.getElementById("notFound");

    if (searchInput) {
        searchInput.addEventListener("input", function () {

            let keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            products.forEach(product => {

                let name = product.getAttribute("data-name");

                if (name && name.includes(keyword)) {
                    product.style.display = "block";
                    visibleCount++;
                } else {
                    product.style.display = "none";
                }

            });

            if (notFound) {
                notFound.style.display = (visibleCount === 0) ? "block" : "none";
            }
        });
    }

});