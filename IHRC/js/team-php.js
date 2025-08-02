// IHRC Team Management System - PHP API Integration
// Updated version for PHP backend without database

class TeamManager {
  constructor() {
    // API Base URL - Update this for your hosting environment
    this.apiBaseUrl = this.getApiBaseUrl();

    // Pagination settings
    this.membersPerPage = 12;
    this.currentPage = 1;
    this.totalPages = 1;
    this.totalMembers = 0;
    this.states = [];

    // Current filters
    this.currentSearch = "";
    this.currentState = "";

    // Initialize the system
    this.init();
  }

  getApiBaseUrl() {
    // Auto-detect API base URL based on current location
    const currentDomain = window.location.origin;
    const currentPath = window.location.pathname.replace(/\/[^\/]*$/, "");

    // For local development
    if (
      window.location.hostname === "localhost" ||
      window.location.hostname === "127.0.0.1"
    ) {
      return `${currentDomain}${currentPath}/php/api.php`;
    }

    // For production - adjust path as needed
    return `${currentDomain}${currentPath}/php/api.php`;
  }

  async init() {
    this.showLoading();
    this.setupEventListeners();
    await this.loadMembers();
  }

  setupEventListeners() {
    // Search functionality with debouncing
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
      let searchTimeout;
      searchInput.addEventListener("input", (e) => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
          this.currentSearch = e.target.value.trim();
          this.currentPage = 1;
          this.loadMembers();
        }, 300);
      });
    }

    // State filter
    const stateFilter = document.getElementById("stateFilter");
    if (stateFilter) {
      stateFilter.addEventListener("change", (e) => {
        this.currentState = e.target.value;
        this.currentPage = 1;
        this.loadMembers();
      });
    }

    // View toggle buttons
    const gridViewBtn = document.getElementById("gridViewBtn");
    const listViewBtn = document.getElementById("listViewBtn");
    const container = document.getElementById("membersContainer");

    if (gridViewBtn && listViewBtn && container) {
      gridViewBtn.addEventListener("click", () => {
        container.className = "members-grid";
        gridViewBtn.classList.add("active");
        listViewBtn.classList.remove("active");
        localStorage.setItem("viewMode", "grid");
      });

      listViewBtn.addEventListener("click", () => {
        container.className = "members-list";
        listViewBtn.classList.add("active");
        gridViewBtn.classList.remove("active");
        localStorage.setItem("viewMode", "list");
      });

      // Restore saved view mode
      const savedView = localStorage.getItem("viewMode") || "grid";
      if (savedView === "list") {
        listViewBtn.click();
      } else {
        gridViewBtn.click();
      }
    }
  }

  async loadMembers() {
    try {
      this.showLoading();

      const params = new URLSearchParams({
        page: this.currentPage,
        limit: this.membersPerPage,
      });

      if (this.currentSearch) {
        params.append("search", this.currentSearch);
      }

      if (this.currentState) {
        params.append("state", this.currentState);
      }

      const response = await fetch(`${this.apiBaseUrl}/members?${params}`);

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();

      if (data.success) {
        this.updatePaginationInfo(data.data.pagination);
        this.states = data.data.states || [];
        this.renderMembers(data.data.members);
        this.renderPagination();
        this.populateStateFilter();
        this.updateMemberCount(data.data.pagination.total_members);
      } else {
        throw new Error(data.message || "Failed to load members");
      }
    } catch (error) {
      console.error("Error loading members:", error);
      this.showError(`Failed to load team members: ${error.message}`);
    }
  }

  updatePaginationInfo(pagination) {
    this.currentPage = pagination.current_page;
    this.totalPages = pagination.total_pages;
    this.totalMembers = pagination.total_members;
  }

  renderMembers(members) {
    const container = document.getElementById("membersContainer");

    if (!members || members.length === 0) {
      container.innerHTML = `
        <div class="no-results">
          <i class="fas fa-users"></i>
          <h3>No Team Members Found</h3>
          <p>No members match your current search criteria.</p>
        </div>
      `;
      return;
    }

    const membersHTML = members
      .map((member) => this.createMemberCard(member))
      .join("");
    container.innerHTML = membersHTML;
  }

  createMemberCard(member) {
    const initials = member.name
      .split(" ")
      .map((n) => n[0])
      .join("")
      .toUpperCase();

    return `
      <div class="member-card">
        <div class="member-photo">
          ${
            member.photo
              ? `<img src="${member.photo}" alt="${member.name}" onerror="this.parentNode.innerHTML='<div class=\\'default-avatar\\'>${initials}</div>'">`
              : `<div class="default-avatar">${initials}</div>`
          }
        </div>
        <div class="member-info">
          <div class="member-name">${member.name}</div>
          <div class="member-post">${member.post}</div>
          <div class="member-state">
            <i class="fas fa-map-marker-alt"></i>
            ${member.state}
          </div>
          ${
            member.email
              ? `
            <div class="member-contact">
              <i class="fas fa-envelope"></i>
              <a href="mailto:${member.email}">${member.email}</a>
            </div>
          `
              : ""
          }
          ${
            member.phone
              ? `
            <div class="member-contact">
              <i class="fas fa-phone"></i>
              <a href="tel:${member.phone}">${member.phone}</a>
            </div>
          `
              : ""
          }
        </div>
      </div>
    `;
  }

  renderPagination() {
    const pagination = document.getElementById("pagination");

    if (this.totalPages <= 1) {
      pagination.innerHTML = "";
      return;
    }

    let paginationHTML = `
      <button onclick="teamManager.goToPage(${this.currentPage - 1})" ${
      this.currentPage === 1 ? "disabled" : ""
    }>
        <i class="fas fa-chevron-left"></i> Previous
      </button>
    `;

    // Page numbers
    const startPage = Math.max(1, this.currentPage - 2);
    const endPage = Math.min(this.totalPages, this.currentPage + 2);

    if (startPage > 1) {
      paginationHTML += `<button onclick="teamManager.goToPage(1)">1</button>`;
      if (startPage > 2) {
        paginationHTML += `<span>...</span>`;
      }
    }

    for (let i = startPage; i <= endPage; i++) {
      paginationHTML += `
        <button onclick="teamManager.goToPage(${i})" ${
        i === this.currentPage ? 'class="active"' : ""
      }>
          ${i}
        </button>
      `;
    }

    if (endPage < this.totalPages) {
      if (endPage < this.totalPages - 1) {
        paginationHTML += `<span>...</span>`;
      }
      paginationHTML += `<button onclick="teamManager.goToPage(${this.totalPages})">${this.totalPages}</button>`;
    }

    paginationHTML += `
      <button onclick="teamManager.goToPage(${this.currentPage + 1})" ${
      this.currentPage === this.totalPages ? "disabled" : ""
    }>
        Next <i class="fas fa-chevron-right"></i>
      </button>
    `;

    pagination.innerHTML = paginationHTML;
  }

  goToPage(page) {
    if (page >= 1 && page <= this.totalPages && page !== this.currentPage) {
      this.currentPage = page;
      this.loadMembers();
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  }

  populateStateFilter() {
    const stateFilter = document.getElementById("stateFilter");

    if (!stateFilter) return;

    const currentValue = stateFilter.value;
    stateFilter.innerHTML = '<option value="">All States</option>';

    this.states.forEach((state) => {
      const option = document.createElement("option");
      option.value = state;
      option.textContent = state;
      if (state === currentValue) {
        option.selected = true;
      }
      stateFilter.appendChild(option);
    });
  }

  updateMemberCount(count) {
    const countElement = document.getElementById("memberCount");
    if (countElement) {
      countElement.textContent = `${count} team members`;
    }
  }

  showError(message) {
    const container = document.getElementById("membersContainer");
    container.innerHTML = `
      <div class="error-message">
        <i class="fas fa-exclamation-triangle"></i>
        <h3>Unable to Load Team Data</h3>
        <p>${message}</p>
        <button onclick="teamManager.loadMembers()" class="retry-btn">
          <i class="fas fa-redo"></i> Retry
        </button>
      </div>
    `;
  }

  showLoading() {
    const container = document.getElementById("membersContainer");
    container.innerHTML = `
      <div class="loading-message">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Loading team members...</p>
      </div>
    `;
  }
}

// Admin API functionality for PHP backend
class AdminAPI {
  constructor() {
    this.apiBaseUrl = this.getApiBaseUrl();
    this.token = localStorage.getItem("adminToken");
  }

  getApiBaseUrl() {
    const currentDomain = window.location.origin;
    const currentPath = window.location.pathname.replace(/\/[^\/]*$/, "");

    if (
      window.location.hostname === "localhost" ||
      window.location.hostname === "127.0.0.1"
    ) {
      return `${currentDomain}${currentPath}/php/api.php`;
    }

    return `${currentDomain}${currentPath}/php/api.php`;
  }

  async login(email, password) {
    try {
      const response = await fetch(`${this.apiBaseUrl}/auth/login`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email, password }),
      });

      const data = await response.json();

      if (data.success) {
        this.token = data.data.token;
        localStorage.setItem("adminToken", data.data.token);
        localStorage.setItem("adminUser", JSON.stringify(data.data.user));
        return { success: true, user: data.data.user };
      } else {
        return { success: false, message: data.message };
      }
    } catch (error) {
      console.error("Login error:", error);
      return { success: false, message: "Network error occurred" };
    }
  }

  async logout() {
    try {
      if (this.token) {
        await fetch(`${this.apiBaseUrl}/auth/logout`, {
          method: "POST",
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        });
      }
    } catch (error) {
      console.error("Logout error:", error);
    } finally {
      this.token = null;
      localStorage.removeItem("adminToken");
      localStorage.removeItem("adminUser");
    }
  }

  async createMember(memberData) {
    try {
      const response = await fetch(`${this.apiBaseUrl}/members`, {
        method: "POST",
        headers: {
          ...this.getAuthHeaders(),
          "Content-Type": "application/json",
        },
        body: JSON.stringify(memberData),
      });

      const data = await response.json();
      return data;
    } catch (error) {
      console.error("Create member error:", error);
      return { success: false, message: "Failed to create member" };
    }
  }

  async updateMember(memberId, memberData) {
    try {
      const response = await fetch(`${this.apiBaseUrl}/members/${memberId}`, {
        method: "PUT",
        headers: {
          ...this.getAuthHeaders(),
          "Content-Type": "application/json",
        },
        body: JSON.stringify(memberData),
      });

      const data = await response.json();
      return data;
    } catch (error) {
      console.error("Update member error:", error);
      return { success: false, message: "Failed to update member" };
    }
  }

  async deleteMember(memberId) {
    try {
      const response = await fetch(`${this.apiBaseUrl}/members/${memberId}`, {
        method: "DELETE",
        headers: this.getAuthHeaders(),
      });

      const data = await response.json();
      return data;
    } catch (error) {
      console.error("Delete member error:", error);
      return { success: false, message: "Failed to delete member" };
    }
  }

  getAuthHeaders() {
    const headers = {};
    if (this.token) {
      headers["Authorization"] = `Bearer ${this.token}`;
    }
    return headers;
  }

  isAuthenticated() {
    return !!this.token;
  }

  getCurrentUser() {
    const user = localStorage.getItem("adminUser");
    return user ? JSON.parse(user) : null;
  }
}

// Initialize team manager when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  window.teamManager = new TeamManager();
  window.adminAPI = new AdminAPI();
  console.log("IHRC Team Management System initialized with PHP backend");
});

// Add CSS for improved styling
const style = document.createElement("style");
style.textContent = `
  .loading-message, .error-message, .no-results {
    text-align: center;
    padding: 40px;
    color: #666;
  }
  
  .loading-message i, .error-message i, .no-results i {
    font-size: 48px;
    margin-bottom: 20px;
    display: block;
  }
  
  .error-message {
    color: #d32f2f;
  }
  
  .no-results {
    color: #757575;
  }
  
  .retry-btn {
    background: #1976d2;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 15px;
    font-size: 14px;
  }
  
  .retry-btn:hover {
    background: #1565c0;
  }
  
  .default-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    font-weight: bold;
    margin: 0 auto;
  }

  .member-contact {
    margin-top: 8px;
    font-size: 14px;
  }

  .member-contact i {
    margin-right: 8px;
    color: #666;
    width: 16px;
  }

  .member-contact a {
    color: #1976d2;
    text-decoration: none;
  }

  .member-contact a:hover {
    text-decoration: underline;
  }
`;
document.head.appendChild(style);
