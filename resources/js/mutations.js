import Vue from 'vue'

export default {
  establecerUser(state, user) {
    state.user = user
  },
  establecerUrlQuery(state, query) {
    state.url_query = query
  },
  openSidebar(state) {
    state.sidebarOpened = true
    state.obfuscatorActive = true
  },
  closeSidebar(state) {
    state.sidebarOpened = false
    state.obfuscatorActive = false
  },
  locationChange(state) {
    state.sidebarOpened = false
    state.obfuscatorActive = false
  },
  windowResize(state) {
    const { innerWidth } = window
    const isMobile = innerWidth > 1024
    state.isMobile = isMobile
    state.sidebarOpened = isMobile
  }
}
