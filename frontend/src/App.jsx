import Login from './pages/login/Login';

function App() {
  const isAuthenticated = false;

  return isAuthenticated ? (
    <div style={{ fontFamily: 'sans-serif', padding: '20px' }}>
      <h1>Área Restrita - Palpiteiro FC</h1>
    </div>
  ) : (
    <Login />
  );
}

export default App;