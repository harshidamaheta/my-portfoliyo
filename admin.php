<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Portfolio Admin — Demo (Frontend Only)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=General+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { sans: ['General Sans', 'ui-sans-serif', 'system-ui'] },
          colors: {
            grape: {
              50: '#f6f3ff',
              100: '#ece6ff',
              200: '#d7cdff',
              300: '#b7a4ff',
              400: '#9877ff',
              500: '#7a4bff',
              600: '#6131e6',
              700: '#4b25b8',
              800: '#3b1f93',
              900: '#331b7a'
            },
            teal: {
              50: '#eafffb',
              100: '#c6fff5',
              200: '#94fdec',
              300: '#59f2dd',
              400: '#2fd3c0',
              500: '#18b2a2',
              600: '#0f9187',
              700: '#0d736b',
              800: '#0f5b57',
              900: '#0f4a47'
            },
            ink: {
              25:'#f8fafc',
              50:'#f2f6fb',
              100:'#e6edf6',
              200:'#d3dfef',
              300:'#b6c8e2',
              400:'#8aa4c7',
              500:'#6a88ad',
              600:'#556e90',
              700:'#425772',
              800:'#324359',
              900:'#283649'
            }
          },
          boxShadow: {
            glow: '0 0 0 8px rgba(122,75,255,0.08)',
            soft: '0 14px 40px rgba(0,0,0,0.08)'
          },
          animation: {
            blob: 'blob 22s ease-in-out infinite',
            float: 'float 8s ease-in-out infinite'
          },
          keyframes: {
            blob: {
              '0%':{ transform:'translate(0,0) scale(1)' },
              '33%':{ transform:'translate(12px,-10px) scale(1.05)' },
              '66%':{ transform:'translate(-10px,10px) scale(.97)' },
              '100%':{ transform:'translate(0,0) scale(1)' }
            },
            float: { '0%,100%':{ transform:'translateY(0)' }, '50%':{ transform:'translateY(-6px)' } }
          }
        }
      }
    }
  </script>
  <style>
    .bg-app {
      background:
        radial-gradient(900px 600px at -10% -10%, rgba(122,75,255,0.12), transparent 60%),
        radial-gradient(900px 600px at 110% 10%, rgba(24,178,162,0.12), transparent 60%),
        linear-gradient(120deg, #f7fbff, #f9f6ff);
    }
    .dark .bg-app {
      background:
        radial-gradient(900px 600px at -10% -10%, rgba(122,75,255,0.18), transparent 60%),
        radial-gradient(900px 600px at 110% 10%, rgba(24,178,162,0.14), transparent 60%),
        linear-gradient(120deg, #0d141e, #0b111b);
    }
    .glass { background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); }
    .dark .glass { background: rgba(18,23,33,0.6); }
    .card {
      border-radius: 1.25rem;
      background: linear-gradient(180deg, rgba(255,255,255,.95), rgba(255,255,255,.90));
      border: 1px solid rgba(255,255,255,0.7);
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    .dark .card {
      background: linear-gradient(180deg, rgba(22,29,43,.9), rgba(22,29,43,.82));
      border: 1px solid rgba(255,255,255,0.06);
      box-shadow: 0 10px 30px rgba(0,0,0,0.45);
    }
    .ring-gradient { position:relative; }
    .ring-gradient:before {
      content:'';
      position:absolute; inset:-1px;
      border-radius:1.25rem; padding:1px;
      background: linear-gradient(120deg, rgba(122,75,255,0.35), rgba(24,178,162,0.35));
      -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
      -webkit-mask-composite: xor; mask-composite: exclude;
      pointer-events: none;
    }
    .badge { display:inline-flex; align-items:center; gap:.35rem; padding:.25rem .6rem; border-radius:9999px; font-weight:700; font-size:.7rem; }
    .modal-enter { opacity: 0; transform: translateY(12px) scale(.98); }
    .modal-enter.active { opacity: 1; transform: translateY(0) scale(1); transition: all 220ms ease; }
    .sticky-th th { position: sticky; top: 0; z-index: 1; }
  </style>
</head>
<body class="font-sans bg-app min-h-screen text-ink-800 dark:text-ink-100">
  <!-- Ambient shapes -->
  <div class="pointer-events-none fixed inset-0 -z-10">
    <div class="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-grape-500/10 blur-3xl animate-blob"></div>
    <div class="absolute top-40 -right-24 w-72 h-72 rounded-full bg-teal-500/10 blur-3xl animate-blob"></div>
  </div>

  <!-- Demo notice -->
  <div class="fixed top-3 left-1/2 -translate-x-1/2 z-50">
    <div class="glass px-4 py-2 rounded-full text-xs font-semibold text-grape-800 dark:text-grape-200 shadow-soft">
      Demo Admin — No server/PHP. Data saves in your browser.
    </div>
  </div>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-80 shrink-0 hidden lg:flex flex-col p-4 gap-4">
      <div class="ring-gradient card relative p-4">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-grape-500 to-teal-500 grid place-items-center text-white font-extrabold shadow-glow">PA</div>
          <div>
            <div class="text-xl font-extrabold tracking-tight">Portfolio Admin</div>
            <div class="text-xs text-ink-500 dark:text-ink-400">Manage your site</div>
          </div>
        </div>
        <div class="absolute right-4 top-4">
          <span class="badge bg-grape-50 text-grape-700 dark:bg-grape-500/15 dark:text-grape-200">v1.0</span>
        </div>
      </div>

      <nav class="ring-gradient card p-2 space-y-1">
        <button data-nav="dashboard" class="navlink w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-semibold hover:bg-grape-50/70 dark:hover:bg-white/5 transition active">🏠 Dashboard</button>
        <button data-nav="projects" class="navlink w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-semibold hover:bg-grape-50/70 dark:hover:bg-white/5 transition">🧩 Projects</button>
        <button data-nav="skills" class="navlink w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-semibold hover:bg-grape-50/70 dark:hover:bg-white/5 transition">💡 Skills</button>
        <button data-nav="about" class="navlink w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-semibold hover:bg-grape-50/70 dark:hover:bg-white/5 transition">👤 About</button>
        <button data-nav="socials" class="navlink w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-semibold hover:bg-grape-50/70 dark:hover:bg-white/5 transition">🔗 Socials</button>
        <button data-nav="preview" class="navlink w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-semibold hover:bg-grape-50/70 dark:hover:bg-white/5 transition">🖥️ Preview</button>
        <button data-nav="settings" class="navlink w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-semibold hover:bg-grape-50/70 dark:hover:bg-white/5 transition">⚙️ Settings</button>
      </nav>

      <div class="mt-auto ring-gradient card p-4">
        <div class="text-sm font-semibold">Quick Stats</div>
        <div class="mt-3 grid grid-cols-3 gap-3 text-center">
          <div class="p-2 rounded-xl bg-ink-25 dark:bg-white/5">
            <div id="statProjects" class="text-2xl font-extrabold text-grape-700 dark:text-grape-300">0</div>
            <div class="text-[11px] text-ink-500">Projects</div>
          </div>
          <div class="p-2 rounded-xl bg-ink-25 dark:bg-white/5">
            <div id="statSkills" class="text-2xl font-extrabold text-grape-700 dark:text-grape-300">0</div>
            <div class="text-[11px] text-ink-500">Skills</div>
          </div>
          <div class="p-2 rounded-xl bg-ink-25 dark:bg-white/5">
            <div id="statPublished" class="text-2xl font-extrabold text-grape-700 dark:text-grape-300">0</div>
            <div class="text-[11px] text-ink-500">Published</div>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main -->
    <main class="flex-1">
      <!-- Topbar -->
      <header class="glass sticky top-0 z-40 border-b border-white/60 dark:border-white/10">
        <div class="px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <button id="openSidebar" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white/80 dark:bg-white/10 border border-white/70 dark:border-white/10 shadow-soft">☰</button>
            <div class="text-xl sm:text-2xl font-extrabold">Admin Panel</div>
            <span class="hidden sm:flex items-center gap-2 text-xs text-ink-500"><span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span> Online</span>
          </div>
          <div class="flex items-center gap-2 sm:gap-3">
            <button id="themeToggle" class="px-3 py-2 rounded-xl bg-white/80 dark:bg-white/10 border border-white/70 dark:border-white/10 hover:shadow-soft">🌙</button>
            <button id="addProjectQuick" class="hidden sm:inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 shadow-glow hover:from-grape-600 hover:to-teal-600 transition">
              ＋ Add Project
            </button>
          </div>
        </div>
      </header>

      <!-- Content -->
      <section class="p-4 sm:p-6 space-y-6">
        <!-- Dashboard -->
        <div data-view="dashboard" class="view space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="ring-gradient card p-5">
              <div class="text-sm font-semibold text-ink-600 dark:text-ink-300">Projects</div>
              <div class="mt-2 text-3xl font-extrabold" id="dashProjects">0</div>
              <div class="mt-2 text-xs text-ink-500" id="dashPublished">0 published</div>
            </div>
            <div class="ring-gradient card p-5">
              <div class="text-sm font-semibold text-ink-600 dark:text-ink-300">Skills</div>
              <div class="mt-2 text-3xl font-extrabold" id="dashSkills">0</div>
              <div class="mt-2 text-xs text-ink-500" id="dashTopSkill">Top: —</div>
            </div>
            <div class="ring-gradient card p-5">
              <div class="text-sm font-semibold text-ink-600 dark:text-ink-300">Brand</div>
              <div class="mt-2 text-lg font-bold text-grape-800 dark:text-grape-200" id="dashName">Your Name</div>
              <div class="text-xs text-ink-500" id="dashHeadline">—</div>
              <div class="mt-3">
                <button data-nav="preview" class="navlink inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-grape-50/70 dark:hover:bg-white/10">Open Preview →</button>
              </div>
            </div>
          </div>

          <div class="ring-gradient card p-5">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-lg font-extrabold">Recent Projects</div>
                <div class="text-xs text-ink-500">Last 5 items</div>
              </div>
              <div class="flex gap-2">
                <button data-nav="projects" class="navlink px-3 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-grape-50/70 dark:hover:bg-white/10">View All</button>
                <button id="quickAddDash" class="px-3 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600">＋ New</button>
              </div>
            </div>
            <div id="recentList" class="mt-4 divide-y divide-ink-100 dark:divide-white/10"></div>
          </div>
        </div>

        <!-- Projects -->
        <div data-view="projects" class="view hidden space-y-4">
          <div class="ring-gradient card p-5">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
              <div>
                <div class="text-lg font-extrabold">Projects</div>
                <div class="text-xs text-ink-500">Create, edit, publish</div>
              </div>
              <div class="flex gap-2">
                <button id="addProjectBtn" class="px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600 shadow-glow">＋ Add Project</button>
                <button id="exportJSON" class="px-4 py-2 rounded-xl bg-ink-25 dark:bg-white/5 border border-white/60 dark:border-white/10 hover:bg-ink-50 dark:hover:bg-white/10">⬇️ Export JSON</button>
              </div>
            </div>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-3">
              <div class="md:col-span-2">
                <input id="searchProjects" type="text" placeholder="Search title, tag, description..." class="w-full px-4 py-3 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5 outline-none focus:shadow-glow" />
              </div>
              <div>
                <select id="filterStatus" class="w-full px-4 py-3 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5">
                  <option value="">All Status</option>
                  <option value="Published">Published</option>
                  <option value="Draft">Draft</option>
                </select>
              </div>
              <div>
                <input id="filterTag" type="text" placeholder="Filter by tag" class="w-full px-4 py-3 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
              </div>
            </div>
          </div>

          <div class="ring-gradient card p-0 overflow-hidden">
            <div class="min-w-full overflow-x-auto">
              <table class="w-full text-sm">
                <thead class="sticky-th bg-grape-50/60 dark:bg-white/5 text-ink-800 dark:text-ink-100 backdrop-blur">
                  <tr>
                    <th class="text-left px-4 py-3">Title</th>
                    <th class="text-left px-4 py-3">Tags</th>
                    <th class="text-left px-4 py-3">Status</th>
                    <th class="text-left px-4 py-3">Link</th>
                    <th class="text-right px-4 py-3">Actions</th>
                  </tr>
                </thead>
                <tbody id="projectsTbody" class="divide-y divide-ink-100 dark:divide-white/10"></tbody>
              </table>
              <div id="noProjects" class="hidden text-center text-ink-500 text-sm py-8">No projects found</div>
            </div>
          </div>
        </div>

        <!-- Skills -->
        <div data-view="skills" class="view hidden space-y-4">
          <div class="ring-gradient card p-5">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-lg font-extrabold">Skills</div>
                <div class="text-xs text-ink-500">Add and rate your skills</div>
              </div>
              <button id="addSkillBtn" class="px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600 shadow-glow">＋ Add Skill</button>
            </div>
          </div>
          <div id="skillsGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4"></div>
          <div id="noSkills" class="hidden text-center text-ink-500 text-sm py-8">No skills yet</div>
        </div>

        <!-- About -->
        <div data-view="about" class="view hidden space-y-4">
          <div class="ring-gradient card p-5">
            <div class="text-lg font-extrabold">About</div>
            <div class="text-xs text-ink-500">Update your personal info</div>
            <form id="aboutForm" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-semibold mb-1">Name</label>
                <input id="aboutName" type="text" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
              </div>
              <div>
                <label class="block text-xs font-semibold mb-1">Headline</label>
                <input id="aboutHeadline" type="text" placeholder="e.g. Frontend Developer" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
              </div>
              <div class="md:col-span-2">
                <label class="block text-xs font-semibold mb-1">Bio</label>
                <textarea id="aboutBio" rows="4" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5"></textarea>
              </div>
              <div>
                <label class="block text-xs font-semibold mb-1">Location</label>
                <input id="aboutLocation" type="text" placeholder="City, Country" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
              </div>
              <div class="flex items-center gap-3">
                <input id="aboutAvailable" type="checkbox" class="w-5 h-5 rounded border-ink-200 dark:border-white/20" />
                <label for="aboutAvailable" class="text-sm">Open to opportunities</label>
              </div>
              <div class="md:col-span-2 flex justify-end">
                <button class="px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600">Save About</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Socials -->
        <div data-view="socials" class="view hidden space-y-4">
          <div class="ring-gradient card p-5">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-lg font-extrabold">Social Links</div>
                <div class="text-xs text-ink-500">Add your profiles</div>
              </div>
              <button id="addSocialBtn" class="px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600 shadow-glow">＋ Add Social</button>
            </div>
          </div>
          <div id="socialsGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4"></div>
          <div id="noSocials" class="hidden text-center text-ink-500 text-sm py-8">No social links yet</div>
        </div>

        <!-- Preview -->
        <div data-view="preview" class="view hidden space-y-4">
          <div class="ring-gradient card p-5">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-lg font-extrabold">Live Preview</div>
                <div class="text-xs text-ink-500">See how your portfolio looks</div>
              </div>
              <div class="flex gap-2">
                <button data-nav="projects" class="navlink px-3 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-grape-50/70 dark:hover:bg-white/10">Edit Projects</button>
                <button data-nav="about" class="navlink px-3 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-grape-50/70 dark:hover:bg-white/10">Edit About</button>
              </div>
            </div>
          </div>

          <div id="previewCanvas" class="ring-gradient card p-0 overflow-hidden">
            <!-- Hero -->
            <section class="p-8 sm:p-10 bg-gradient-to-br from-grape-500/10 to-teal-500/10 dark:from-white/5 dark:to-white/5">
              <div class="max-w-5xl mx-auto">
                <div class="text-3xl sm:text-4xl font-extrabold" id="pvName">Your Name</div>
                <div class="mt-1 text-ink-600 dark:text-ink-300" id="pvHeadline">Headline</div>
                <div class="mt-3 flex flex-wrap gap-2" id="pvChips"></div>
                <div class="mt-4 flex flex-wrap gap-3" id="pvSocials"></div>
              </div>
            </section>
            <!-- Projects -->
            <section class="p-6 sm:p-8">
              <div class="max-w-5xl mx-auto">
                <div class="text-xl font-extrabold">Projects</div>
                <div id="pvProjects" class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                <div id="pvNoProjects" class="hidden text-ink-500 text-sm py-6">No published projects yet</div>
              </div>
            </section>
            <!-- Skills -->
            <section class="px-6 sm:px-8 pb-8">
              <div class="max-w-5xl mx-auto">
                <div class="text-xl font-extrabold">Skills</div>
                <div id="pvSkills" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                <div id="pvNoSkills" class="hidden text-ink-500 text-sm py-6">No skills added yet</div>
              </div>
            </section>
          </div>
        </div>

        <!-- Settings -->
        <div data-view="settings" class="view hidden space-y-4">
          <div class="ring-gradient card p-5">
            <div class="text-lg font-extrabold">Settings</div>
            <div class="text-xs text-ink-500">Customize your demo</div>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="card p-4">
                <div class="font-semibold">Theme</div>
                <div class="mt-3 flex items-center gap-3">
                  <button id="themeLight" class="px-3 py-2 rounded-lg bg-ink-25 dark:bg-white/5">Light</button>
                  <button id="themeDark" class="px-3 py-2 rounded-lg bg-ink-900 text-white">Dark</button>
                </div>
              </div>
              <div class="card p-4">
                <div class="font-semibold">Data</div>
                <div class="mt-3 flex flex-wrap items-center gap-3">
                  <button id="seedData" class="px-3 py-2 rounded-lg bg-grape-500 text-white hover:bg-grape-600">Seed Sample Data</button>
                  <button id="clearData" class="px-3 py-2 rounded-lg bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">Clear All Data</button>
                </div>
                <div class="mt-4">
                  <div class="text-sm font-semibold mb-1">Import JSON</div>
                  <textarea id="importText" rows="4" placeholder='Paste exported JSON here' class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5"></textarea>
                  <div class="mt-2 flex justify-end">
                    <button id="importJSON" class="px-3 py-2 rounded-lg bg-teal-500 text-white hover:bg-teal-600">Import</button>
                  </div>
                </div>
                <div class="mt-2 text-xs text-ink-500">Your data lives only in this browser.</div>
              </div>
            </div>
          </div>
        </div>

      </section>
    </main>
  </div>

  <!-- MODALS -->
  <!-- Project Modal -->
  <div id="projectModal" class="fixed inset-0 hidden z-50">
    <div class="absolute inset-0 bg-ink-900/50"></div>
    <div class="relative max-w-2xl mx-auto mt-10 p-4">
      <div class="modal-enter active card p-5 sm:p-6">
        <div class="flex items-center justify-between">
          <div class="text-lg font-extrabold" id="projectModalTitle">Add Project</div>
          <button data-close="projectModal" class="w-9 h-9 grid place-items-center rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">✕</button>
        </div>
        <form id="projectForm" class="mt-4 space-y-3">
          <input type="hidden" id="projectId" />
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-semibold mb-1">Title</label>
              <input id="projectTitle" required type="text" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
            </div>
            <div>
              <label class="block text-xs font-semibold mb-1">Status</label>
              <select id="projectStatus" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5">
                <option>Draft</option>
                <option>Published</option>
              </select>
            </div>
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Description</label>
            <textarea id="projectDesc" rows="3" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5"></textarea>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-semibold mb-1">Tags (comma-separated)</label>
              <input id="projectTags" type="text" placeholder="react, ui, webapp" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
            </div>
            <div>
              <label class="block text-xs font-semibold mb-1">Link URL</label>
              <input id="projectLink" type="url" placeholder="https://..." class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
            </div>
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Image URL (optional)</label>
            <input id="projectImage" type="url" placeholder="https://example.com/image.jpg" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
          </div>
          <div class="pt-2 flex justify-end gap-2">
            <button type="button" data-close="projectModal" class="px-4 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Skill Modal -->
  <div id="skillModal" class="fixed inset-0 hidden z-50">
    <div class="absolute inset-0 bg-ink-900/50"></div>
    <div class="relative max-w-xl mx-auto mt-10 p-4">
      <div class="modal-enter active card p-5 sm:p-6">
        <div class="flex items-center justify-between">
          <div class="text-lg font-extrabold" id="skillModalTitle">Add Skill</div>
          <button data-close="skillModal" class="w-9 h-9 grid place-items-center rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">✕</button>
        </div>
        <form id="skillForm" class="mt-4 space-y-3">
          <input type="hidden" id="skillId" />
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-semibold mb-1">Name</label>
              <input id="skillName" required type="text" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
            </div>
            <div>
              <label class="block text-xs font-semibold mb-1">Level (0-100)</label>
              <input id="skillLevel" type="number" min="0" max="100" value="70" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
            </div>
          </div>
          <div class="pt-2 flex justify-end gap-2">
            <button type="button" data-close="skillModal" class="px-4 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Social Modal -->
  <div id="socialModal" class="fixed inset-0 hidden z-50">
    <div class="absolute inset-0 bg-ink-900/50"></div>
    <div class="relative max-w-xl mx-auto mt-10 p-4">
      <div class="modal-enter active card p-5 sm:p-6">
        <div class="flex items-center justify-between">
          <div class="text-lg font-extrabold" id="socialModalTitle">Add Social</div>
          <button data-close="socialModal" class="w-9 h-9 grid place-items-center rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">✕</button>
        </div>
        <form id="socialForm" class="mt-4 space-y-3">
          <input type="hidden" id="socialId" />
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-semibold mb-1">Platform</label>
              <input id="socialPlatform" placeholder="GitHub, LinkedIn..." required type="text" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
            </div>
            <div>
              <label class="block text-xs font-semibold mb-1">URL</label>
              <input id="socialUrl" placeholder="https://..." required type="url" class="w-full px-3 py-2 rounded-xl border border-ink-100 dark:border-white/10 bg-white dark:bg-white/5" />
            </div>
          </div>
          <div class="pt-2 flex justify-end gap-2">
            <button type="button" data-close="socialModal" class="px-4 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded-xl text-white bg-gradient-to-r from-grape-500 to-teal-500 hover:from-grape-600 hover:to-teal-600">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Confirm Modal -->
  <div id="confirmModal" class="fixed inset-0 hidden z-50">
    <div class="absolute inset-0 bg-ink-900/50"></div>
    <div class="relative max-w-md mx-auto mt-24 p-4">
      <div class="modal-enter active card p-5 sm:p-6">
        <div class="text-lg font-extrabold" id="confirmTitle">Confirm</div>
        <div class="mt-2 text-sm text-ink-600 dark:text-ink-200" id="confirmMessage">Are you sure?</div>
        <div class="mt-4 flex justify-end gap-2">
          <button data-close="confirmModal" class="px-4 py-2 rounded-xl bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10">Cancel</button>
          <button id="confirmYes" class="px-4 py-2 rounded-xl text-white bg-red-500 hover:bg-red-600">Yes, Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div id="toast" class="fixed bottom-4 left-1/2 -translate-x-1/2 z-50 hidden">
    <div class="rounded-full px-4 py-2 text-sm font-semibold text-white bg-ink-900/90 dark:bg-ink-900">Saved</div>
  </div>

  <script>
    // Storage
    const store = {
      get(key, fallback){ try { return JSON.parse(localStorage.getItem(key)) ?? fallback; } catch(e) { return fallback; } },
      set(key, val){ localStorage.setItem(key, JSON.stringify(val)); }
    };

    // State
    let state = {
      about: store.get('pf_about', { name:'Your Name', headline:'', bio:'', location:'', available:false }),
      projects: store.get('pf_projects', []),
      skills: store.get('pf_skills', []),
      socials: store.get('pf_socials', []),
      theme: store.get('pf_theme', 'light')
    };

    // Utils
    const $ = s => document.querySelector(s);
    const $$ = s => document.querySelectorAll(s);
    const uid = () => Math.random().toString(36).slice(2,10);
    const toast = (m='Saved') => { const t=$('#toast'); t.firstChild.textContent=m; t.classList.remove('hidden'); setTimeout(()=>t.classList.add('hidden'),1400); };
    const saveAll = () => { store.set('pf_about', state.about); store.set('pf_projects', state.projects); store.set('pf_skills', state.skills); store.set('pf_socials', state.socials); store.set('pf_theme', state.theme); };

    // Theme
    function applyTheme(){ document.documentElement.classList.toggle('dark', state.theme === 'dark'); }
    $('#themeToggle').addEventListener('click', ()=>{ state.theme = state.theme==='dark'?'light':'dark'; saveAll(); applyTheme(); toast(state.theme==='dark'?'Dark mode on':'Light mode on'); });
    $('#themeLight')?.addEventListener('click', ()=>{ state.theme='light'; saveAll(); applyTheme(); toast('Theme: Light'); });
    $('#themeDark')?.addEventListener('click', ()=>{ state.theme='dark'; saveAll(); applyTheme(); toast('Theme: Dark'); });

    // Navigation
    function showView(key){
      $$('.view').forEach(v=>v.classList.add('hidden'));
      document.querySelector(`[data-view="${key}"]`)?.classList.remove('hidden');
      $$('.navlink').forEach(n=>n.classList.remove('active','bg-grape-50/70','dark:bg-white/10'));
      document.querySelectorAll(`.navlink[data-nav="${key}"]`).forEach(n=>n.classList.add('active','bg-grape-50/70','dark:bg-white/10'));
      if(window.innerWidth<1024){ $('#sidebar')?.classList.add('hidden'); }
      refreshAll();
    }
    $('#openSidebar')?.addEventListener('click', ()=>{
      const sb = $('#sidebar');
      sb.classList.remove('hidden'); sb.classList.add('fixed','inset-y-0','left-0','z-50','w-72','p-4','glass');
      const closer = (e) => {
        if (!sb.contains(e.target) && e.target !== $('#openSidebar')) {
          sb.classList.add('hidden'); sb.classList.remove('fixed','inset-y-0','left-0','z-50','w-72','p-4','glass');
          document.removeEventListener('click', closer);
        }
      };
      setTimeout(()=>document.addEventListener('click', closer),0);
    });
    $$('.navlink').forEach(b=>b.addEventListener('click', ()=>showView(b.dataset.nav)));

    // Dashboard renders
    function renderDashboard(){
      const published = state.projects.filter(p=>p.status==='Published').length;
      $('#statProjects').textContent = state.projects.length;
      $('#statSkills').textContent = state.skills.length;
      $('#statPublished').textContent = published;
      $('#dashProjects').textContent = state.projects.length;
      $('#dashSkills').textContent = state.skills.length;
      $('#dashPublished').textContent = `${published} published`;
      $('#dashName').textContent = state.about.name || 'Your Name';
      $('#dashHeadline').textContent = state.about.headline || '—';

      // Recent
      const wrap = $('#recentList'); wrap.innerHTML='';
      const list = [...state.projects].slice(-5).reverse();
      if(list.length===0){ wrap.innerHTML='<div class="text-sm text-ink-500 py-6 text-center">No recent projects</div>'; return; }
      list.forEach(p=>{
        const row = document.createElement('div');
        row.className='py-3 flex items-center justify-between gap-3';
        row.innerHTML = `
          <div class="min-w-0">
            <div class="font-semibold truncate">${p.title}</div>
            <div class="text-xs text-ink-500">${(p.tags||[]).join(', ') || 'no tags'} • ${p.status}</div>
          </div>
          <div><span class="badge ${p.status==='Published'?'bg-teal-50 text-teal-700 dark:bg-teal-500/15 dark:text-teal-200':'bg-ink-25 text-ink-700 dark:bg-white/5 dark:text-ink-200'}">${p.status}</span></div>
        `;
        wrap.appendChild(row);
      });
    }

    // Projects
    function renderProjects(){
      const tbody = $('#projectsTbody');
      const no = $('#noProjects');
      const q = $('#searchProjects').value.trim().toLowerCase();
      const fs = $('#filterStatus').value;
      const ft = $('#filterTag').value.trim().toLowerCase();
      let items = [...state.projects];

      items = items.filter(p=>{
        const hay = [p.title, (p.tags||[]).join(' '), p.desc].join(' ').toLowerCase();
        let ok = hay.includes(q);
        if(fs) ok = ok && p.status===fs;
        if(ft) ok = ok && (p.tags||[]).some(t=>t.toLowerCase().includes(ft));
        return ok;
      });

      tbody.innerHTML='';
      if(items.length===0){ no.classList.remove('hidden'); return; }
      no.classList.add('hidden');

      items.forEach(p=>{
        const tr = document.createElement('tr');
        tr.className='hover:bg-ink-25/70 dark:hover:bg-white/5';
        tr.innerHTML = `
          <td class="px-4 py-3 font-semibold">${p.title}</td>
          <td class="px-4 py-3">${(p.tags||[]).join(', ') || '—'}</td>
          <td class="px-4 py-3">
            <select data-action="status" data-id="${p.id}" class="px-2 py-1 rounded-lg bg-ink-25 dark:bg-white/5 border border-ink-100 dark:border-white/10 text-xs">
              ${['Draft','Published'].map(s=>`<option ${s===p.status?'selected':''}>${s}</option>`).join('')}
            </select>
          </td>
          <td class="px-4 py-3">
            ${p.link? `<a href="${p.link}" target="_blank" rel="noopener noreferrer" class="text-grape-700 dark:text-grape-300 underline">Open</a>` : '—'}
          </td>
          <td class="px-4 py-3 text-right">
            <div class="inline-flex gap-2">
              <button data-action="edit" data-id="${p.id}" class="px-3 py-1 rounded-lg bg-grape-50 text-grape-800 dark:bg-grape-500/15 dark:text-grape-200 hover:bg-grape-100 dark:hover:bg-grape-500/25 text-xs">Edit</button>
              <button data-action="delete" data-id="${p.id}" class="px-3 py-1 rounded-lg bg-rose-50 text-rose-700 dark:bg-rose-500/15 dark:text-rose-200 hover:bg-rose-100 dark:hover:bg-rose-500/25 text-xs">Delete</button>
            </div>
          </td>
        `;
        tbody.appendChild(tr);
      });

      tbody.querySelectorAll('button, select').forEach(el=>{
        const id = el.getAttribute('data-id');
        const action = el.getAttribute('data-action');
        if(action==='edit') el.addEventListener('click', ()=>openProjectModal(id));
        if(action==='delete') el.addEventListener('click', ()=>confirmDelete('project', id));
        if(action==='status') el.addEventListener('change', (e)=>{ const p=state.projects.find(x=>x.id===id); if(p){ p.status=e.target.value; saveAll(); toast('Status updated'); refreshAll(); } });
      });
    }

    // Skills
    function renderSkills(){
      const grid = $('#skillsGrid'); grid.innerHTML='';
      if(state.skills.length===0) $('#noSkills').classList.remove('hidden'); else $('#noSkills').classList.add('hidden');
      state.skills.forEach(s=>{
        const card = document.createElement('div');
        card.className='ring-gradient card p-5 flex flex-col gap-3';
        card.innerHTML = `
          <div class="flex items-center justify-between">
            <div class="text-lg font-extrabold">${s.name}</div>
            <span class="badge bg-teal-50 text-teal-700 dark:bg-teal-500/15 dark:text-teal-200">${s.level}%</span>
          </div>
          <div class="h-2 rounded-full bg-ink-100 dark:bg-white/10 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-grape-500 to-teal-500 rounded-full" style="width:${Math.min(100, Math.max(0, Number(s.level)||0))}%"></div>
          </div>
          <div class="flex justify-end gap-2">
            <button data-action="edit" data-id="${s.id}" class="px-3 py-1 rounded-lg bg-grape-50 text-grape-800 dark:bg-grape-500/15 dark:text-grape-200 hover:bg-grape-100 dark:hover:bg-grape-500/25 text-xs">Edit</button>
            <button data-action="delete" data-id="${s.id}" class="px-3 py-1 rounded-lg bg-rose-50 text-rose-700 dark:bg-rose-500/15 dark:text-rose-200 hover:bg-rose-100 dark:hover:bg-rose-500/25 text-xs">Delete</button>
          </div>
        `;
        grid.appendChild(card);
      });
      grid.querySelectorAll('button').forEach(b=>{
        const id=b.getAttribute('data-id'); const action=b.getAttribute('data-action');
        if(action==='edit') b.addEventListener('click', ()=>openSkillModal(id));
        if(action==='delete') b.addEventListener('click', ()=>confirmDelete('skill', id));
      });
    }

    // Socials
    function renderSocials(){
      const grid = $('#socialsGrid'); grid.innerHTML='';
      if(state.socials.length===0) $('#noSocials').classList.remove('hidden'); else $('#noSocials').classList.add('hidden');
      state.socials.forEach(s=>{
        const card=document.createElement('div');
        card.className='ring-gradient card p-5 flex items-center justify-between gap-3';
        card.innerHTML=`
          <div class="min-w-0">
            <div class="font-extrabold">${s.platform}</div>
            <div class="text-xs text-ink-500 truncate">${s.url}</div>
          </div>
          <div class="flex gap-2">
            <a href="${s.url}" target="_blank" rel="noopener noreferrer" class="px-3 py-1 rounded-lg bg-ink-25 dark:bg-white/5 hover:bg-ink-50 dark:hover:bg-white/10 text-xs">Open</a>
            <button data-action="edit" data-id="${s.id}" class="px-3 py-1 rounded-lg bg-grape-50 text-grape-800 dark:bg-grape-500/15 dark:text-grape-200 hover:bg-grape-100 dark:hover:bg-grape-500/25 text-xs">Edit</button>
            <button data-action="delete" data-id="${s.id}" class="px-3 py-1 rounded-lg bg-rose-50 text-rose-700 dark:bg-rose-500/15 dark:text-rose-200 hover:bg-rose-100 dark:hover:bg-rose-500/25 text-xs">Delete</button>
          </div>
        `;
        grid.appendChild(card);
      });
      grid.querySelectorAll('button').forEach(b=>{
        const id=b.getAttribute('data-id'); const action=b.getAttribute('data-action');
        if(action==='edit') b.addEventListener('click', ()=>openSocialModal(id));
        if(action==='delete') b.addEventListener('click', ()=>confirmDelete('social', id));
      });
    }

    // About
    function renderAboutForm(){
      $('#aboutName').value = state.about.name || '';
      $('#aboutHeadline').value = state.about.headline || '';
      $('#aboutBio').value = state.about.bio || '';
      $('#aboutLocation').value = state.about.location || '';
      $('#aboutAvailable').checked = !!state.about.available;
    }
    $('#aboutForm').addEventListener('submit', (e)=>{
      e.preventDefault();
      state.about = {
        name: $('#aboutName').value.trim(),
        headline: $('#aboutHeadline').value.trim(),
        bio: $('#aboutBio').value.trim(),
        location: $('#aboutLocation').value.trim(),
        available: $('#aboutAvailable').checked
      };
      saveAll(); toast('About saved'); refreshAll();
    });

    // Preview
    function renderPreview(){
      $('#pvName').textContent = state.about.name || 'Your Name';
      $('#pvHeadline').textContent = state.about.headline || '';
      const chips = $('#pvChips'); chips.innerHTML='';
      if(state.about.location){ chips.insertAdjacentHTML('beforeend', `<span class="badge bg-ink-25 dark:bg-white/5">📍 ${state.about.location}</span>`); }
      if(state.about.available){ chips.insertAdjacentHTML('beforeend', `<span class="badge bg-teal-50 text-teal-700 dark:bg-teal-500/15 dark:text-teal-200">Available</span>`); }

      // Socials
      const pvSocials = $('#pvSocials'); pvSocials.innerHTML='';
      state.socials.forEach(s=>{
        const btn = document.createElement('a');
        btn.href = s.url; btn.target = '_blank'; btn.rel='noopener noreferrer';
        btn.className = 'px-3 py-2 rounded-lg bg-white dark:bg-white/5 border border-ink-100 dark:border-white/10 hover:bg-ink-50 dark:hover:bg-white/10';
        btn.textContent = s.platform;
        pvSocials.appendChild(btn);
      });

      // Projects
      const grid = $('#pvProjects'); grid.innerHTML='';
      const visible = state.projects.filter(p=>p.status==='Published');
      if(visible.length===0){ $('#pvNoProjects').classList.remove('hidden'); } else { $('#pvNoProjects').classList.add('hidden'); }
      visible.forEach(p=>{
        const card = document.createElement('div');
        card.className='card overflow-hidden';
        card.innerHTML = `
          <div class="h-40 bg-ink-50 dark:bg-white/5 overflow-hidden">
            ${p.image ? `<img src="${p.image}" alt="${p.title} image" class="w-full h-full object-cover" onerror="this.src=''; this.alt='Image failed to load'; this.style.display='none';">` : `
              <div class="w-full h-full grid place-items-center text-ink-400">No image</div>
            `}
          </div>
          <div class="p-4">
            <div class="font-extrabold">${p.title}</div>
            <div class="text-sm text-ink-600 dark:text-ink-300 line-clamp-3">${p.desc || ''}</div>
            <div class="mt-2 flex flex-wrap gap-1">
              ${(p.tags||[]).map(t=>`<span class="badge bg-ink-25 dark:bg-white/5">${t}</span>`).join('')}
            </div>
            <div class="mt-3">
              ${p.link ? `<a href="${p.link}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-grape-700 dark:text-grape-300 underline">Visit →</a>` : ''}
            </div>
          </div>
        `;
        grid.appendChild(card);
      });

      // Skills
      const pvSkills = $('#pvSkills'); pvSkills.innerHTML='';
      if(state.skills.length===0){ $('#pvNoSkills').classList.remove('hidden'); } else { $('#pvNoSkills').classList.add('hidden'); }
      state.skills.forEach(s=>{
        const row = document.createElement('div');
        row.className='card p-4';
        row.innerHTML = `
          <div class="flex items-center justify-between">
            <div class="font-semibold">${s.name}</div>
            <div class="text-xs text-ink-500">${s.level}%</div>
          </div>
          <div class="mt-2 h-2 rounded-full bg-ink-100 dark:bg-white/10 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-grape-500 to-teal-500 rounded-full" style="width:${Math.min(100, Math.max(0, Number(s.level)||0))}%"></div>
          </div>
        `;
        pvSkills.appendChild(row);
      });
    }

    // Modals open
    function openProjectModal(id=null){
      const m = $('#projectModal'); m.classList.remove('hidden');
      if(id){
        const p = state.projects.find(x=>x.id===id);
        $('#projectModalTitle').textContent = 'Edit Project';
        $('#projectId').value = p.id;
        $('#projectTitle').value = p.title;
        $('#projectStatus').value = p.status;
        $('#projectDesc').value = p.desc || '';
        $('#projectTags').value = (p.tags||[]).join(', ');
        $('#projectLink').value = p.link || '';
        $('#projectImage').value = p.image || '';
      } else {
        $('#projectModalTitle').textContent = 'Add Project';
        $('#projectId').value=''; $('#projectTitle').value=''; $('#projectStatus').value='Draft'; $('#projectDesc').value=''; $('#projectTags').value=''; $('#projectLink').value=''; $('#projectImage').value='';
      }
    }
    function openSkillModal(id=null){
      const m = $('#skillModal'); m.classList.remove('hidden');
      if(id){
        const s = state.skills.find(x=>x.id===id);
        $('#skillModalTitle').textContent = 'Edit Skill';
        $('#skillId').value=s.id; $('#skillName').value=s.name; $('#skillLevel').value=s.level;
      } else {
        $('#skillModalTitle').textContent = 'Add Skill';
        $('#skillId').value=''; $('#skillName').value=''; $('#skillLevel').value=70;
      }
    }
    function openSocialModal(id=null){
      const m = $('#socialModal'); m.classList.remove('hidden');
      if(id){
        const s = state.socials.find(x=>x.id===id);
        $('#socialModalTitle').textContent='Edit Social';
        $('#socialId').value=s.id; $('#socialPlatform').value=s.platform; $('#socialUrl').value=s.url;
      } else {
        $('#socialModalTitle').textContent='Add Social';
        $('#socialId').value=''; $('#socialPlatform').value=''; $('#socialUrl').value='';
      }
    }

    // Close modals
    document.querySelectorAll('[data-close]').forEach(b => b.addEventListener('click', ()=> b.closest('.fixed')?.classList.add('hidden')));
    ['projectModal','skillModal','socialModal','confirmModal'].forEach(id=>{
      const m=document.getElementById(id); if(!m) return;
      m.addEventListener('click', (e)=>{ if(e.target===m) m.classList.add('hidden'); });
    });

    // Project submit
    $('#projectForm').addEventListener('submit', (e)=>{
      e.preventDefault();
      const id = $('#projectId').value || uid();
      const payload = {
        id,
        title: $('#projectTitle').value.trim(),
        status: $('#projectStatus').value,
        desc: $('#projectDesc').value.trim(),
        tags: $('#projectTags').value.split(',').map(t=>t.trim()).filter(Boolean),
        link: $('#projectLink').value.trim(),
        image: $('#projectImage').value.trim()
      };
      const idx = state.projects.findIndex(x=>x.id===id);
      if(idx>=0) state.projects[idx]=payload; else state.projects.push(payload);
      saveAll(); toast('Project saved'); $('#projectModal').classList.add('hidden'); refreshAll(); showView('projects');
    });

    // Skill submit
    $('#skillForm').addEventListener('submit', (e)=>{
      e.preventDefault();
      const id = $('#skillId').value || uid();
      const payload = {
        id, name: $('#skillName').value.trim(), level: Math.max(0, Math.min(100, Number($('#skillLevel').value)||0))
      };
      const idx = state.skills.findIndex(x=>x.id===id);
      if(idx>=0) state.skills[idx]=payload; else state.skills.push(payload);
      saveAll(); toast('Skill saved'); $('#skillModal').classList.add('hidden'); refreshAll();
    });

    // Social submit
    $('#socialForm').addEventListener('submit', (e)=>{
      e.preventDefault();
      const id = $('#socialId').value || uid();
      const payload = { id, platform: $('#socialPlatform').value.trim(), url: $('#socialUrl').value.trim() };
      const idx = state.socials.findIndex(x=>x.id===id);
      if(idx>=0) state.socials[idx]=payload; else state.socials.push(payload);
      saveAll(); toast('Social saved'); $('#socialModal').classList.add('hidden'); refreshAll();
    });

    // Confirm delete
    let confirmCtx = null;
    function confirmDelete(type, id){
      confirmCtx = { type, id };
      $('#confirmTitle').textContent = 'Confirm deletion';
      const msg = { project:'Delete this project?', skill:'Delete this skill?', social:'Delete this social link?' }[type] || 'Are you sure?';
      $('#confirmMessage').textContent = msg;
      $('#confirmModal').classList.remove('hidden');
    }
    $('#confirmYes').addEventListener('click', ()=>{
      if(!confirmCtx) return;
      const {type, id} = confirmCtx;
      if(type==='project') state.projects = state.projects.filter(x=>x.id!==id);
      if(type==='skill') state.skills = state.skills.filter(x=>x.id!==id);
      if(type==='social') state.socials = state.socials.filter(x=>x.id!==id);
      saveAll(); toast('Deleted'); $('#confirmModal').classList.add('hidden'); confirmCtx=null; refreshAll();
    });

    // Search/filter events
    $('#searchProjects').addEventListener('input', renderProjects);
    $('#filterStatus').addEventListener('change', renderProjects);
    $('#filterTag').addEventListener('input', renderProjects);

    // Quick actions
    $('#addProjectBtn')?.addEventListener('click', ()=>openProjectModal());
    $('#addProjectQuick')?.addEventListener('click', ()=>openProjectModal());
    $('#quickAddDash')?.addEventListener('click', ()=>openProjectModal());
    $('#addSkillBtn')?.addEventListener('click', ()=>openSkillModal());
    $('#addSocialBtn')?.addEventListener('click', ()=>openSocialModal());

    // Export JSON
    $('#exportJSON').addEventListener('click', ()=>{
      const data = { about: state.about, projects: state.projects, skills: state.skills, socials: state.socials };
      const blob = new Blob([JSON.stringify(data, null, 2)], {type:'application/json;charset=utf-8;'});
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a'); a.href=url; a.download='portfolio-data.json'; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
    });

    // Import JSON
    $('#importJSON').addEventListener('click', ()=>{
      try {
        const txt = $('#importText').value.trim();
        if(!txt) return toast('Paste JSON first');
        const data = JSON.parse(txt);
        if(data.about) state.about = data.about;
        if(Array.isArray(data.projects)) state.projects = data.projects;
        if(Array.isArray(data.skills)) state.skills = data.skills;
        if(Array.isArray(data.socials)) state.socials = data.socials;
        saveAll(); toast('Imported'); refreshAll();
      } catch(e){ toast('Invalid JSON'); }
    });

    // Seed/Clear
    $('#seedData').addEventListener('click', ()=>{
      const p1 = { id:uid(), title:'Personal Website', status:'Published', desc:'A modern portfolio built with a11y in mind.', tags:['portfolio','design'], link:'https://example.com', image:'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&q=80' };
      const p2 = { id:uid(), title:'React UI Kit', status:'Draft', desc:'Reusable components and tokens.', tags:['react','ui','storybook'], link:'', image:'' };
      const s1 = { id:uid(), name:'JavaScript', level:88 };
      const s2 = { id:uid(), name:'React', level:84 };
      const s3 = { id:uid(), name:'CSS / Tailwind', level:90 };
      const soc1 = { id:uid(), platform:'GitHub', url:'https://github.com/yourname' };
      const soc2 = { id:uid(), platform:'LinkedIn', url:'https://linkedin.com/in/yourname' };
      state.about = { name:'Alex Rivera', headline:'Frontend Developer', bio:'I build fast, accessible web apps with delightful UX.', location:'Barcelona, ES', available:true };
      state.projects = [p1,p2]; state.skills=[s1,s2,s3]; state.socials=[soc1,soc2];
      saveAll(); toast('Sample data added'); refreshAll();
    });
    $('#clearData').addEventListener('click', ()=>{
      state.about = { name:'Your Name', headline:'', bio:'', location:'', available:false };
      state.projects = []; state.skills=[]; state.socials=[];
      saveAll(); toast('All data cleared'); refreshAll();
    });

    // Refresh All
    function refreshAll(){
      renderDashboard();
      renderProjects();
      renderSkills();
      renderSocials();
      renderAboutForm();
      renderPreview();
    }

    // Init
    applyTheme();
    showView('dashboard');
  </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'98166a3a51b14061',t:'MTc1ODI1NjkzMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
