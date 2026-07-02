import { configureStore } from '@reduxjs/toolkit';
import authReducer from '../features/auth/authSlice';

export const store = configureStore({
    reducer: {
        auth: authReducer,
        // No futuro adicionaremos aqui: jogo: jogoReducer, ranking: rankingReducer
    }
});