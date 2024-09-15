<template>
    <div class="settings-page">
      <h1>Settings</h1>
  
      <div class="section">
        <h2>Account</h2>
        <form @submit.prevent="updateAccount">
          <div class="form-group">
            <label for="username">Username</label>
            <input id="username" v-model="username" type="text" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" v-model="email" type="email" required>
          </div>
          <button type="submit">Save Changes</button>
        </form>
      </div>
  
      <div class="section">
        <h2>Preferences</h2>
        <form @submit.prevent="updatePreferences">
          <div class="form-group">
            <label for="theme">Theme</label>
            <select id="theme" v-model="theme">
              <option value="light">Light</option>
              <option value="dark">Dark</option>
            </select>
          </div>
          <div class="form-group">
            <label for="language">Language</label>
            <select id="language" v-model="language">
              <option value="en">English</option>
              <option value="es">Español</option>
              <option value="fr">Français</option>
            </select>
          </div>
          <button type="submit">Save Changes</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent } from 'vue'
  
  export default defineComponent({
    name: 'SettingsPage',
    data() {
      return {
        username: '',
        email: '',
        theme: 'light',
        language: 'en'
      }
    },
    methods: {
      updateAccount() {
        // Code to update account settings
        console.log('Updating account settings:', { username: this.username, email: this.email })
      },
      updatePreferences() {
        // Code to update user preferences
        console.log('Updating preferences:', { theme: this.theme, language: this.language })
      }
    }
  })
  </script>
  
  <style scoped>
  .settings-page {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
  }
  
  .section {
    margin-bottom: 2rem;
  }
  
  .form-group {
    margin-bottom: 1rem;
  }
  
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5rem;
  }
  
  input, select {
    display: block;
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
  }
  
  button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border-radius: 0.25rem;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>