import { defineStore } from 'pinia';

const useAuth = defineStore('auth', {
  state: () => ({
    showAuth: false,
  }),
  actions: {
    openAuth() {
      this.showAuth = true;
    },
    closeAuth() {
      this.showAuth = false;
    },
  },
});

export default useAuth;