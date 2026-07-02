import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import api from '../../api/cliente';

export const loginUsuario = createAsyncThunk(
    'auth/login',
    async (credenciais, { rejectWithValue }) => {
        try {
            const response = await api.post('/login', credenciais);
            localStorage.setItem('token', response.data.access_token);
            
            return response.data; 
        } catch (error) {
            return rejectWithValue(error.response?.data?.message || 'Erro ao logar');
        }
    }
);

const authSlice = createSlice({
    name: 'auth',
    initialState: {
        usuario: null,
        token: localStorage.getItem('token') || null,
        carregando: false,
        erro: null
    },
    reducers: {
        logout: (state) => {
            localStorage.removeItem('token');
            state.usuario = null;
            state.token = null;
        }
    },
extraReducers: (builder) => {
        builder
            .addCase(loginUsuario.pending, (state) => {
                state.carregando = true;
                state.erro = null;
            })
            .addCase(loginUsuario.fulfilled, (state, action) => {
                state.carregando = false;
                state.token = action.payload.access_token; 
                state.usuario = action.payload.usuario; 
            })
            .addCase(loginUsuario.rejected, (state, action) => {
                state.carregando = false;
                state.erro = action.payload;
            });
    }
});

export const { logout } = authSlice.actions;
export default authSlice.reducer;