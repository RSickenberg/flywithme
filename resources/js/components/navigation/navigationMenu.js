export class NavigationMenu {
  isVisible = false;

  navToggle(element) {
    let btn = element;
    let mobileNav = document.getElementById('mobile_menu');

    btn.classList.toggle('open');
    mobileNav.classList.toggle('hidden');

    this.isVisible = !this.isVisible;
    this.animate(mobileNav, this.isVisible);
  }

  animate(element, toVisibleState) {
    console.debug('[NavigationMenu] Animation is not supported yet.')
  }
}
