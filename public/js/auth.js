document.addEventListener("DOMContentLoaded", () => {
  // Tab switching
  const authTabs = document.querySelectorAll(".auth-tab")
  const authForms = document.querySelectorAll(".auth-form")

  if (authTabs.length > 0) {
    authTabs.forEach((tab) => {
      tab.addEventListener("click", function () {
        // Get tab ID
        const tabId = this.dataset.tab

        // Remove active class from all tabs and forms
        authTabs.forEach((t) => t.classList.remove("active"))
        authForms.forEach((f) => f.classList.remove("active"))

        // Add active class to clicked tab and corresponding form
        this.classList.add("active")
        document.getElementById(tabId + "Form").classList.add("active")
      })
    })
  }
})
