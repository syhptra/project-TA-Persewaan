<script>
  const toggleBtn = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");
  const content = document.getElementById("content");

  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("hidden");
    content.classList.toggle("expanded");
  });

  document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll("#sidebarnav a, .sidebar-section ul li a");

    links.forEach(link => {
      link.addEventListener("click", e => {
        const submenu = link.nextElementSibling;
        if (submenu && submenu.tagName === "UL") {
          e.preventDefault();
          submenu.classList.toggle("in");
        }
      });
    });
  });
</script>
