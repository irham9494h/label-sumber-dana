import "./bootstrap";

document.addEventListener("alpine:init", () => {
    Alpine.store("subMobileMenu", {
        isMobileSubMenuOpen: false,
        openMobileSubMenu() {
            this.isMobileSubMenuOpen = true;
        },
    });
});
