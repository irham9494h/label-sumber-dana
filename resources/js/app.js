import "./bootstrap";

document.addEventListener("alpine:init", () => {
    Alpine.store("menu", {
        showMobileMenu: false,
        showSubMobileMenu: false,
        isSidebarCollapse: Alpine.$persist(false).as("sidebarCollapse"),

        toggleShowMobileMenu() {
            this.showMobileMenu = !this.showMobileMenu;
        },

        toggleShowSubMobileMenu() {
            this.showSubMobileMenu = !this.showSubMobileMenu;
        },

        toggleSidebarCollapse() {
            this.isSidebarCollapse = !this.isSidebarCollapse;
        },
    });
});
