# REST API Laravel Sanctum - Contoh Implementasi Frontend

## 📱 Implementasi Lengkap di Frontend

Dokumen ini menunjukkan berbagai cara mengimplementasikan REST API Laravel Sanctum di aplikasi frontend.

---

## 1️⃣ Vanilla JavaScript dengan Fetch API

### Setup Dasar

```javascript
// config.js
export const API_BASE_URL = 'http://localhost:8000/api';

export const getToken = () => localStorage.getItem('api_token');

export const setToken = (token) => localStorage.setItem('api_token', token);

export const removeToken = () => localStorage.removeItem('api_token');

// API Helper
export const apiCall = async (method, endpoint, data = null) => {
  const headers = {
    'Content-Type': 'application/json'
  };
  
  const token = getToken();
  if (token) {
    headers['Authorization'] = `Bearer ${token}`;
  }
  
  const options = {
    method,
    headers
  };
  
  if (data && (method === 'POST' || method === 'PUT')) {
    options.body = JSON.stringify(data);
  }
  
  try {
    const response = await fetch(`${API_BASE_URL}${endpoint}`, options);
    const result = await response.json();
    
    if (!response.ok) {
      throw new Error(result.message || 'API Error');
    }
    
    return result;
  } catch (error) {
    console.error('API Error:', error);
    throw error;
  }
};
```

### Module Autentikasi

```javascript
// auth.js
import { apiCall, setToken, removeToken, getToken } from './config.js';

export const AuthService = {
  async register(name, email, password, passwordConfirmation) {
    const result = await apiCall('POST', '/auth/register', {
      name,
      email,
      password,
      password_confirmation: passwordConfirmation
    });
    
    if (result.success) {
      setToken(result.token);
    }
    
    return result;
  },
  
  async login(email, password) {
    const result = await apiCall('POST', '/auth/login', {
      email,
      password
    });
    
    if (result.success) {
      setToken(result.token);
    }
    
    return result;
  },
  
  async logout() {
    const result = await apiCall('POST', '/auth/logout');
    
    if (result.success) {
      removeToken();
    }
    
    return result;
  },
  
  async getProfile() {
    return apiCall('GET', '/auth/me');
  },
  
  async refreshToken() {
    const result = await apiCall('POST', '/auth/refresh');
    
    if (result.success) {
      setToken(result.token);
    }
    
    return result;
  },
  
  isAuthenticated() {
    return !!getToken();
  }
};
```

### Module Produk

```javascript
// products.js
import { apiCall } from './config.js';

export const ProductService = {
  async getAll() {
    const result = await apiCall('GET', '/products');
    return result.data || [];
  },
  
  async getById(id) {
    const result = await apiCall('GET', `/products/${id}`);
    return result.data;
  },
  
  async create(productData) {
    return apiCall('POST', '/products', productData);
  },
  
  async update(id, productData) {
    return apiCall('PUT', `/products/${id}`, productData);
  },
  
  async delete(id) {
    return apiCall('DELETE', `/products/${id}`);
  },
  
  async search(keyword, status) {
    let endpoint = '/products/search?';
    
    if (keyword) {
      endpoint += `keyword=${encodeURIComponent(keyword)}&`;
    }
    
    if (status) {
      endpoint += `status=${status}`;
    }
    
    const result = await apiCall('GET', endpoint);
    return result.data || [];
  }
};
```

### HTML & Usage

```html
<!DOCTYPE html>
<html>
<head>
  <title>API Test</title>
  <style>
    body { font-family: Arial; margin: 20px; }
    .section { border: 1px solid #ccc; padding: 20px; margin: 10px 0; }
    input, button { padding: 8px; margin: 5px; }
    button { background: #007bff; color: white; border: none; cursor: pointer; }
    .error { color: red; }
    .success { color: green; }
    pre { background: #f4f4f4; padding: 10px; overflow: auto; }
  </style>
</head>
<body>
  <h1>REST API Test</h1>
  
  <!-- Auth Section -->
  <div class="section">
    <h2>Autentikasi</h2>
    
    <div>
      <h3>Registrasi</h3>
      <input type="text" id="regName" placeholder="Nama">
      <input type="email" id="regEmail" placeholder="Email">
      <input type="password" id="regPassword" placeholder="Password">
      <input type="password" id="regConfirm" placeholder="Confirm Password">
      <button onclick="handleRegister()">Register</button>
      <div id="regResult"></div>
    </div>
    
    <div>
      <h3>Login</h3>
      <input type="email" id="loginEmail" placeholder="Email">
      <input type="password" id="loginPassword" placeholder="Password">
      <button onclick="handleLogin()">Login</button>
      <div id="loginResult"></div>
    </div>
    
    <button onclick="handleLogout()">Logout</button>
    <button onclick="handleGetProfile()">Get Profile</button>
    <div id="profileResult"></div>
  </div>
  
  <!-- Products Section -->
  <div class="section">
    <h2>Produk</h2>
    
    <div>
      <h3>Buat Produk</h3>
      <input type="text" id="prodName" placeholder="Nama Produk">
      <input type="number" id="prodPrice" placeholder="Harga">
      <input type="text" id="prodUnit" placeholder="Unit (Pcs, Kg, dll)">
      <input type="number" id="prodStock" placeholder="Stock">
      <select id="prodStatus">
        <option value="">-- Pilih Status --</option>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
      <input type="text" id="prodDesc" placeholder="Deskripsi">
      <button onclick="handleCreateProduct()">Buat Produk</button>
      <div id="createResult"></div>
    </div>
    
    <div>
      <h3>Daftar Produk</h3>
      <button onclick="handleGetProducts()">Tampilkan Produk</button>
      <div id="productsResult"></div>
    </div>
    
    <div>
      <h3>Cari Produk</h3>
      <input type="text" id="searchKeyword" placeholder="Kata kunci">
      <select id="searchStatus">
        <option value="">-- Semua Status --</option>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
      <button onclick="handleSearchProducts()">Cari</button>
      <div id="searchResult"></div>
    </div>
  </div>
  
  <script type="module">
    import { AuthService } from './auth.js';
    import { ProductService } from './products.js';
    
    // Expose ke global
    window.AuthService = AuthService;
    window.ProductService = ProductService;
  </script>
  
  <script>
    const displayResult = (elementId, data, error = false) => {
      const element = document.getElementById(elementId);
      const className = error ? 'error' : 'success';
      element.innerHTML = `<div class="${className}"><pre>${JSON.stringify(data, null, 2)}</pre></div>`;
    };
    
    async function handleRegister() {
      const name = document.getElementById('regName').value;
      const email = document.getElementById('regEmail').value;
      const password = document.getElementById('regPassword').value;
      const confirm = document.getElementById('regConfirm').value;
      
      try {
        const result = await window.AuthService.register(name, email, password, confirm);
        displayResult('regResult', result, !result.success);
      } catch (error) {
        displayResult('regResult', error.message, true);
      }
    }
    
    async function handleLogin() {
      const email = document.getElementById('loginEmail').value;
      const password = document.getElementById('loginPassword').value;
      
      try {
        const result = await window.AuthService.login(email, password);
        displayResult('loginResult', result, !result.success);
      } catch (error) {
        displayResult('loginResult', error.message, true);
      }
    }
    
    async function handleLogout() {
      try {
        const result = await window.AuthService.logout();
        displayResult('profileResult', result, !result.success);
      } catch (error) {
        displayResult('profileResult', error.message, true);
      }
    }
    
    async function handleGetProfile() {
      try {
        const result = await window.AuthService.getProfile();
        displayResult('profileResult', result, !result.success);
      } catch (error) {
        displayResult('profileResult', error.message, true);
      }
    }
    
    async function handleCreateProduct() {
      const data = {
        name: document.getElementById('prodName').value,
        price: parseInt(document.getElementById('prodPrice').value),
        unit: document.getElementById('prodUnit').value,
        stock: parseInt(document.getElementById('prodStock').value),
        status: document.getElementById('prodStatus').value,
        description: document.getElementById('prodDesc').value
      };
      
      try {
        const result = await window.ProductService.create(data);
        displayResult('createResult', result, !result.success);
      } catch (error) {
        displayResult('createResult', error.message, true);
      }
    }
    
    async function handleGetProducts() {
      try {
        const products = await window.ProductService.getAll();
        displayResult('productsResult', products, false);
      } catch (error) {
        displayResult('productsResult', error.message, true);
      }
    }
    
    async function handleSearchProducts() {
      const keyword = document.getElementById('searchKeyword').value;
      const status = document.getElementById('searchStatus').value;
      
      try {
        const products = await window.ProductService.search(keyword, status);
        displayResult('searchResult', products, false);
      } catch (error) {
        displayResult('searchResult', error.message, true);
      }
    }
  </script>
</body>
</html>
```

---

## 2️⃣ React dengan Axios

### Setup React App

```bash
npx create-react-app api-client
cd api-client
npm install axios
```

### API Service

```javascript
// src/services/api.js
import axios from 'axios';

const API_BASE_URL = 'http://localhost:8000/api';

const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json'
  }
});

// Interceptor untuk menambah token
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('api_token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

export default api;
```

### Auth Hook

```javascript
// src/hooks/useAuth.js
import { useState, useCallback } from 'react';
import api from '../services/api';

export const useAuth = () => {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  
  const register = useCallback(async (name, email, password, passwordConfirmation) => {
    setLoading(true);
    setError(null);
    
    try {
      const response = await api.post('/auth/register', {
        name,
        email,
        password,
        password_confirmation: passwordConfirmation
      });
      
      if (response.data.success) {
        localStorage.setItem('api_token', response.data.token);
        setUser(response.data.user);
      }
      
      return response.data;
    } catch (err) {
      setError(err.response?.data?.message || 'Registration failed');
      throw err;
    } finally {
      setLoading(false);
    }
  }, []);
  
  const login = useCallback(async (email, password) => {
    setLoading(true);
    setError(null);
    
    try {
      const response = await api.post('/auth/login', {
        email,
        password
      });
      
      if (response.data.success) {
        localStorage.setItem('api_token', response.data.token);
        setUser(response.data.user);
      }
      
      return response.data;
    } catch (err) {
      setError(err.response?.data?.message || 'Login failed');
      throw err;
    } finally {
      setLoading(false);
    }
  }, []);
  
  const logout = useCallback(async () => {
    setLoading(true);
    
    try {
      await api.post('/auth/logout');
      localStorage.removeItem('api_token');
      setUser(null);
    } catch (err) {
      setError(err.response?.data?.message || 'Logout failed');
    } finally {
      setLoading(false);
    }
  }, []);
  
  const getProfile = useCallback(async () => {
    setLoading(true);
    
    try {
      const response = await api.get('/auth/me');
      setUser(response.data.user);
      return response.data.user;
    } catch (err) {
      setError(err.response?.data?.message || 'Failed to get profile');
    } finally {
      setLoading(false);
    }
  }, []);
  
  return {
    user,
    loading,
    error,
    register,
    login,
    logout,
    getProfile,
    isAuthenticated: !!localStorage.getItem('api_token')
  };
};
```

### Products Hook

```javascript
// src/hooks/useProducts.js
import { useState, useCallback } from 'react';
import api from '../services/api';

export const useProducts = () => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  
  const getAll = useCallback(async () => {
    setLoading(true);
    setError(null);
    
    try {
      const response = await api.get('/products');
      setProducts(response.data.data || []);
      return response.data.data;
    } catch (err) {
      setError(err.response?.data?.message || 'Failed to fetch products');
    } finally {
      setLoading(false);
    }
  }, []);
  
  const create = useCallback(async (productData) => {
    setLoading(true);
    setError(null);
    
    try {
      const response = await api.post('/products', productData);
      
      if (response.data.success) {
        setProducts([...products, response.data.data]);
      }
      
      return response.data;
    } catch (err) {
      setError(err.response?.data?.message || 'Failed to create product');
      throw err;
    } finally {
      setLoading(false);
    }
  }, [products]);
  
  const update = useCallback(async (id, productData) => {
    setLoading(true);
    setError(null);
    
    try {
      const response = await api.put(`/products/${id}`, productData);
      
      if (response.data.success) {
        setProducts(products.map(p => p.id === id ? response.data.data : p));
      }
      
      return response.data;
    } catch (err) {
      setError(err.response?.data?.message || 'Failed to update product');
      throw err;
    } finally {
      setLoading(false);
    }
  }, [products]);
  
  const delete_product = useCallback(async (id) => {
    setLoading(true);
    setError(null);
    
    try {
      const response = await api.delete(`/products/${id}`);
      
      if (response.data.success) {
        setProducts(products.filter(p => p.id !== id));
      }
      
      return response.data;
    } catch (err) {
      setError(err.response?.data?.message || 'Failed to delete product');
      throw err;
    } finally {
      setLoading(false);
    }
  }, [products]);
  
  const search = useCallback(async (keyword, status) => {
    setLoading(true);
    setError(null);
    
    try {
      const params = new URLSearchParams();
      if (keyword) params.append('keyword', keyword);
      if (status) params.append('status', status);
      
      const response = await api.get(`/products/search?${params}`);
      return response.data.data || [];
    } catch (err) {
      setError(err.response?.data?.message || 'Search failed');
    } finally {
      setLoading(false);
    }
  }, []);
  
  return {
    products,
    loading,
    error,
    getAll,
    create,
    update,
    delete: delete_product,
    search
  };
};
```

### React Components

```javascript
// src/App.jsx
import { useState } from 'react';
import { useAuth } from './hooks/useAuth';
import { useProducts } from './hooks/useProducts';
import LoginForm from './components/LoginForm';
import ProductList from './components/ProductList';
import ProductForm from './components/ProductForm';

function App() {
  const auth = useAuth();
  const products = useProducts();
  const [showProductForm, setShowProductForm] = useState(false);
  
  if (!auth.isAuthenticated) {
    return <LoginForm onLogin={auth.login} />;
  }
  
  return (
    <div>
      <h1>REST API Dashboard</h1>
      
      <div>
        <p>Welcome, {auth.user?.name}</p>
        <button onClick={auth.logout}>Logout</button>
      </div>
      
      <hr />
      
      <h2>Products</h2>
      
      <button onClick={() => products.getAll()}>Load Products</button>
      <button onClick={() => setShowProductForm(!showProductForm)}>
        {showProductForm ? 'Cancel' : 'Add Product'}
      </button>
      
      {showProductForm && (
        <ProductForm
          onSubmit={(data) => {
            products.create(data).then(() => setShowProductForm(false));
          }}
        />
      )}
      
      <ProductList 
        products={products.products} 
        onDelete={products.delete}
      />
    </div>
  );
}

export default App;
```

---

## 3️⃣ Vue 3 dengan Axios

### Composable

```javascript
// src/composables/useAuth.js
import { ref } from 'vue';
import api from '../api';

export function useAuth() {
  const user = ref(null);
  const token = ref(localStorage.getItem('api_token'));
  const loading = ref(false);
  const error = ref(null);
  
  const register = async (name, email, password, passwordConfirmation) => {
    loading.value = true;
    error.value = null;
    
    try {
      const { data } = await api.post('/auth/register', {
        name,
        email,
        password,
        password_confirmation: passwordConfirmation
      });
      
      if (data.success) {
        token.value = data.token;
        user.value = data.user;
        localStorage.setItem('api_token', data.token);
      }
      
      return data;
    } catch (err) {
      error.value = err.response?.data?.message || 'Registration failed';
      throw err;
    } finally {
      loading.value = false;
    }
  };
  
  const login = async (email, password) => {
    loading.value = true;
    error.value = null;
    
    try {
      const { data } = await api.post('/auth/login', { email, password });
      
      if (data.success) {
        token.value = data.token;
        user.value = data.user;
        localStorage.setItem('api_token', data.token);
      }
      
      return data;
    } catch (err) {
      error.value = err.response?.data?.message || 'Login failed';
      throw err;
    } finally {
      loading.value = false;
    }
  };
  
  const logout = async () => {
    await api.post('/auth/logout');
    token.value = null;
    user.value = null;
    localStorage.removeItem('api_token');
  };
  
  return {
    user,
    token,
    loading,
    error,
    register,
    login,
    logout,
    isAuthenticated: !!token.value
  };
}
```

```javascript
// src/composables/useProducts.js
import { ref } from 'vue';
import api from '../api';

export function useProducts() {
  const products = ref([]);
  const loading = ref(false);
  const error = ref(null);
  
  const getAll = async () => {
    loading.value = true;
    try {
      const { data } = await api.get('/products');
      products.value = data.data || [];
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to fetch';
    } finally {
      loading.value = false;
    }
  };
  
  const create = async (productData) => {
    try {
      const { data } = await api.post('/products', productData);
      if (data.success) {
        products.value.push(data.data);
      }
      return data;
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to create';
      throw err;
    }
  };
  
  const update = async (id, productData) => {
    try {
      const { data } = await api.put(`/products/${id}`, productData);
      if (data.success) {
        const index = products.value.findIndex(p => p.id === id);
        if (index !== -1) {
          products.value[index] = data.data;
        }
      }
      return data;
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to update';
      throw err;
    }
  };
  
  const deleteProduct = async (id) => {
    try {
      const { data } = await api.delete(`/products/${id}`);
      if (data.success) {
        products.value = products.value.filter(p => p.id !== id);
      }
      return data;
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to delete';
      throw err;
    }
  };
  
  return {
    products,
    loading,
    error,
    getAll,
    create,
    update,
    deleteProduct
  };
}
```

---

## 🎯 Best Practices

1. **Tokenize & Store**
   - Simpan token di localStorage atau sessionStorage
   - Jangan hardcode token di code

2. **Error Handling**
   - Tangkap semua error dari API
   - Display error message yang meaningful

3. **Loading State**
   - Show loading indicator saat API call
   - Disable button saat loading

4. **Interceptors**
   - Auto-add token ke setiap request
   - Handle expired token

5. **CORS Setup**
   - Jika frontend dan backend di port berbeda, setup CORS

---

**Happy Coding!** 🚀
