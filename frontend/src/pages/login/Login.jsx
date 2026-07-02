import { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { loginUsuario, logout } from "../../features/auth/authSlice";
import './login.css';



function App() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const dispatch = useDispatch();
  const { token, carregando, erro, usuario } = useSelector((state) => state.auth);

  const handleSubmit = (e) => {
    e.preventDefault();
    dispatch(loginUsuario({ email, password }));
  };

  
  if (token) {
    return (
      <div style={{ padding: '20px', fontFamily: 'sans-serif' }}>
        <h2>Bem-vindo ao Palpiteiro FC</h2>
        <p>Você está autenticado com sucesso.</p>
        {usuario && <p>Olá, {usuario.name}!</p>}
        <button className='btn-login'  onClick={() => dispatch(logout())} >
          Sair / Logout
        </button>
      </div>
    );
  }

  return (
    <div className='login-container'>
      <h2 className='login-title'>Login - Palpiteiro FC</h2>
      
      <form onSubmit={handleSubmit}>
        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px' }}>E-mail:</label>
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            style={{ width: '100%', padding: '8px', boxSizing: 'border-box' }}
          />
        </div>

        <div style={{ marginBottom: '15px' }}>
          <label style={{ display: 'block', marginBottom: '5px' }}>Senha:</label>
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
            style={{ width: '100%', padding: '8px', boxSizing: 'border-box' }}
          />
        </div>

        {erro && <p style={{ color: 'red', fontSize: '14px' }}>⚠️ {erro}</p>}

        <button type="submit" disabled={carregando} className='btn-login'>
          {carregando ? 'Autenticando...' : 'Entrar'}
        </button>
      </form>
    </div>
  );
}

export default App;