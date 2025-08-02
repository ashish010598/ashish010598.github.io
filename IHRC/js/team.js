// Team Members Data Array - Used by Admin Panel
const teamMembers = [
  {
    id: 1,
    name: "Mr. Rajesh Jain",
    post: "Chairperson IHRC",
    state: "Delhi",
    email: "rajesh.jain@ihrc.org",
    phone: "+91-9876543210",
    photo: "../img/team/rajesh.jpeg"
  },
  {
    id: 2,
    name: "Mr. Ashish Pathak",
    post: "IT-Head IHRC",
    state: "Noida",
    email: "ashish.pathak@ihrc.org",
    phone: "+91-9876543211",
    photo: "../img/team/ashish.jpg"
  },
  {
    id: 3,
    name: "Adv. Abhishish Mishra",
    post: "Legal Advisor",
    state: "Uttar Pradesh",
    email: "ashish.mishra@ihrc.org",
    phone: "+91-9876543212",
    photo: ""
  },
  {
    id: 6,
    name: "Ms. Sunita Devi",
    post: "Women Rights Activist",
    state: "Bihar",
    email: "sunita.devi@ihrc.org",
    phone: "+91-9876543215",
    photo: ""
  },
  {
    id: 7,
    name: "Mr. Abdul Rahman",
    post: "Community Outreach Manager",
    state: "West Bengal",
    email: "abdul.rahman@ihrc.org",
    phone: "+91-9876543216",
    photo: ""
  },
  {
    id: 8,
    name: "Dr. Kavita Patel",
    post: "Child Rights Specialist",
    state: "Gujarat",
    email: "kavita.patel@ihrc.org",
    phone: "+91-9876543217",
    photo: ""
  },
  {
    id: 9,
    name: "Mr. Ravi Kumar",
    post: "Documentation Officer",
    state: "Tamil Nadu",
    email: "ravi.kumar@ihrc.org",
    phone: "+91-9876543218",
    photo: ""
  },
  {
    id: 10,
    name: "Ms. Meera Reddy",
    post: "Training Coordinator",
    state: "Telangana",
    email: "meera.reddy@ihrc.org",
    phone: "+91-9876543219",
    photo: ""
  },
  {
    id: 11,
    name: "Mr. Suresh Gupta",
    post: "Finance Manager",
    state: "Haryana",
    email: "suresh.gupta@ihrc.org",
    phone: "+91-9876543220",
    photo: ""
  },
  {
    id: 12,
    name: "Dr. Anita Roy",
    post: "Policy Analyst",
    state: "Odisha",
    email: "anita.roy@ihrc.org",
    phone: "+91-9876543221",
    photo: ""
  },
  {
    id: 13,
    name: "Mr. Deepak Yadav",
    post: "Media Relations Officer",
    state: "Madhya Pradesh",
    email: "deepak.yadav@ihrc.org",
    phone: "+91-9876543222",
    photo: ""
  },
  {
    id: 14,
    name: "Ms. Pooja Agarwal",
    post: "Program Coordinator",
    state: "Uttar Pradesh",
    email: "pooja.agarwal@ihrc.org",
    phone: "+91-9876543223",
    photo: ""
  },
  {
    id: 15,
    name: "Mr. Sanjay Verma",
    post: "Regional Head - North",
    state: "Punjab",
    email: "sanjay.verma@ihrc.org",
    phone: "+91-9876543224",
    photo: ""
  },
  {
    id: 16,
    name: "Madhulata Sharma",
    post: "State Head",
    state: "Uttar Pradesh",
    email: "madhusharmajmd161@gmail.com",
    phone: "9811950487",
    photo: ""
  }
];

// Simple Team Page JavaScript - Static Version
class TeamManager {
  constructor() {
    this.members = [];
    this.filteredMembers = [];
    this.currentPage = 1;
    this.membersPerPage = 12;
    this.currentSearch = "";
    this.currentStateFilter = "";

    this.init();
  }

  async init() {
    this.setupEventListeners();
    this.loadMembers();
  }

  setupEventListeners() {
    // Search functionality
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
      searchInput.addEventListener("input", (e) => {
        this.currentSearch = e.target.value.toLowerCase();
        this.currentPage = 1;
        this.filterAndRenderMembers();
      });
    }

    // State filter
    const stateFilter = document.getElementById("stateFilter");
    if (stateFilter) {
      stateFilter.addEventListener("change", (e) => {
        this.currentStateFilter = e.target.value;
        this.currentPage = 1;
        this.filterAndRenderMembers();
      });
    }
  }

  loadMembers() {
    // Use the global teamMembers array
    this.members = teamMembers || [];
    this.filterAndRenderMembers();
    this.populateStateFilter();
  }

  filterAndRenderMembers() {
    // Filter members based on search and state
    this.filteredMembers = this.members.filter((member) => {
      const matchesSearch =
        !this.currentSearch ||
        member.name.toLowerCase().includes(this.currentSearch) ||
        member.post.toLowerCase().includes(this.currentSearch) ||
        member.state.toLowerCase().includes(this.currentSearch);

      const matchesState =
        !this.currentStateFilter || member.state === this.currentStateFilter;

      return matchesSearch && matchesState;
    });

    this.renderMembers();
    this.renderPagination();
    this.updateResultsInfo();
  }

  renderMembers() {
    const container = document.getElementById("teamGrid");
    const loading = document.getElementById("loading");
    const noResults = document.getElementById("noResults");

    // Hide loading
    if (loading) loading.style.display = "none";

    if (this.filteredMembers.length === 0) {
      container.innerHTML = "";
      if (noResults) noResults.style.display = "block";
      return;
    }

    if (noResults) noResults.style.display = "none";

    // Calculate pagination
    const totalPages = Math.ceil(
      this.filteredMembers.length / this.membersPerPage
    );
    const startIndex = (this.currentPage - 1) * this.membersPerPage;
    const endIndex = startIndex + this.membersPerPage;
    const currentMembers = this.filteredMembers.slice(startIndex, endIndex);

    // Render members
    container.innerHTML = currentMembers
      .map((member) => this.createMemberCard(member))
      .join("");
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
            member.photo && member.photo !== "../img/team/default-avatar.jpg"
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
        </div>
      </div>
    `;
  }

  renderPagination() {
    const totalPages = Math.ceil(
      this.filteredMembers.length / this.membersPerPage
    );
    const pagination = document.getElementById("pagination");

    if (!pagination || totalPages <= 1) {
      if (pagination) pagination.innerHTML = "";
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
    const endPage = Math.min(totalPages, this.currentPage + 2);

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

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        paginationHTML += `<span>...</span>`;
      }
      paginationHTML += `<button onclick="teamManager.goToPage(${totalPages})">${totalPages}</button>`;
    }

    paginationHTML += `
      <button onclick="teamManager.goToPage(${this.currentPage + 1})" ${
      this.currentPage === totalPages ? "disabled" : ""
    }>
        Next <i class="fas fa-chevron-right"></i>
      </button>
    `;

    pagination.innerHTML = paginationHTML;
  }

  goToPage(page) {
    const totalPages = Math.ceil(
      this.filteredMembers.length / this.membersPerPage
    );
    if (page >= 1 && page <= totalPages) {
      this.currentPage = page;
      this.renderMembers();
      this.renderPagination();
      this.updateResultsInfo();
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  }

  populateStateFilter() {
    const stateFilter = document.getElementById("stateFilter");
    if (!stateFilter) return;

    const states = [
      ...new Set(this.members.map((member) => member.state)),
    ].sort();
    const currentValue = stateFilter.value;

    stateFilter.innerHTML = '<option value="">All States</option>';

    states.forEach((state) => {
      const option = document.createElement("option");
      option.value = state;
      option.textContent = state;
      if (state === currentValue) {
        option.selected = true;
      }
      stateFilter.appendChild(option);
    });
  }

  updateResultsInfo() {
    const resultsInfo = document.getElementById("resultsInfo");
    if (resultsInfo) {
      const totalPages = Math.ceil(
        this.filteredMembers.length / this.membersPerPage
      );
      resultsInfo.textContent = `Showing ${this.filteredMembers.length} members`;

      if (totalPages > 1) {
        const startIndex = (this.currentPage - 1) * this.membersPerPage + 1;
        const endIndex = Math.min(
          this.currentPage * this.membersPerPage,
          this.filteredMembers.length
        );
        resultsInfo.textContent = `Showing ${startIndex}-${endIndex} of ${this.filteredMembers.length} members`;
      }
    }
  }
}

// Initialize team manager when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  window.teamManager = new TeamManager();
});
