// Load common components like sidebar, header etc.
document.addEventListener("DOMContentLoaded", () => {
  // Function to load HTML file content and insert it into an element
  const loadHTMLComponent = async (url, targetSelector) => {
    try {
      const response = await fetch(url)
      if (!response.ok) {
        throw new Error(`Failed to load ${url}: ${response.statusText}`)
      }

      const html = await response.text()
      const targetElements = document.querySelectorAll(targetSelector)

      if (targetElements.length === 0) {
        console.warn(`Target element ${targetSelector} not found`)
        return
      }

      targetElements.forEach((element) => {
        element.innerHTML = html
      })

      // Trigger an event to notify that the component was loaded
      document.dispatchEvent(
        new CustomEvent("componentLoaded", {
          detail: { targetSelector },
        }),
      )
    } catch (error) {
      console.error("Error loading component:", error)
    }
  }

  // Load common components
  const loadCommonComponents = () => {
    // Load sidebar into elements with class "sidebar-container"
    const sidebarContainer = document.querySelector(".sidebar-container")
    if (sidebarContainer) {
      loadHTMLComponent("common/sidebar.html", ".sidebar-container")
    }

    // Load header theme toggle into elements with class "theme-toggle-container"
    const themeToggleContainer = document.querySelector(".theme-toggle-container")
    if (themeToggleContainer) {
      loadHTMLComponent("common/header.html", ".theme-toggle-container")
    }
  }

  // Initialize the page components
  loadCommonComponents()

  // Re-initialize sidebar and theme toggle when components are loaded
  document.addEventListener("componentLoaded", (event) => {
    if (event.detail.targetSelector === ".sidebar-container") {
      // Re-initialize sidebar functionality
      if (typeof initializeSidebar === "function") {
        initializeSidebar()
      } else {
        console.warn("initializeSidebar function not found.")
      }
    }

    if (event.detail.targetSelector === ".theme-toggle-container") {
      // Re-initialize theme toggle
      if (typeof setupThemeToggle === "function") {
        setupThemeToggle()
      } else {
        console.warn("setupThemeToggle function not found.")
      }
    }
  })
})
