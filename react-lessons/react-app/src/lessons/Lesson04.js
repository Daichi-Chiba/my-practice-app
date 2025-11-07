// Lesson 04: 状態管理 (useReducer, Context API)

import { useReducer, createContext, useContext } from 'react';

// Reducer関数
function cartReducer(state, action) {
  switch (action.type) {
    case 'ADD_ITEM':
      const existing = state.items.find(item => item.id === action.payload.id);
      if (existing) {
        return {
          ...state,
          items: state.items.map(item =>
            item.id === action.payload.id
              ? { ...item, quantity: item.quantity + 1 }
              : item
          )
        };
      }
      return {
        ...state,
        items: [...state.items, { ...action.payload, quantity: 1 }]
      };

    case 'REMOVE_ITEM':
      return {
        ...state,
        items: state.items.filter(item => item.id !== action.payload)
      };

    case 'CLEAR':
      return { items: [] };

    default:
      return state;
  }
}

// Context作成
const CartContext = createContext();

// Provider コンポーネント
function CartProvider({ children }) {
  const [cart, dispatch] = useReducer(cartReducer, { items: [] });

  const addItem = (item) => dispatch({ type: 'ADD_ITEM', payload: item });
  const removeItem = (id) => dispatch({ type: 'REMOVE_ITEM', payload: id });
  const clearCart = () => dispatch({ type: 'CLEAR' });

  const total = cart.items.reduce((sum, item) => sum + item.price * item.quantity, 0);

  return (
    <CartContext.Provider value={{ cart, addItem, removeItem, clearCart, total }}>
      {children}
    </CartContext.Provider>
  );
}

// カスタムフック
function useCart() {
  return useContext(CartContext);
}

// 商品コンポーネント
function Product({ product }) {
  const { addItem } = useCart();

  return (
    <div style={{
      border: '1px solid #ddd',
      padding: '1rem',
      borderRadius: '8px',
      backgroundColor: 'white'
    }}>
      <h3 style={{ margin: '0 0 0.5rem 0' }}>{product.name}</h3>
      <p style={{ fontSize: '1.5rem', color: '#e74c3c', margin: '0.5rem 0' }}>
        ¥{product.price.toLocaleString()}
      </p>
      <button
        onClick={() => addItem(product)}
        style={{
          padding: '0.5rem 1rem',
          backgroundColor: '#667eea',
          color: 'white',
          border: 'none',
          borderRadius: '4px',
          cursor: 'pointer',
          width: '100%'
        }}
      >
        カートに追加
      </button>
    </div>
  );
}

// カートコンポーネント
function Cart() {
  const { cart, removeItem, clearCart, total } = useCart();

  return (
    <div style={{
      border: '1px solid #ddd',
      padding: '1rem',
      borderRadius: '8px',
      backgroundColor: '#f8f9fa',
      position: 'sticky',
      top: '1rem'
    }}>
      <h2 style={{ margin: '0 0 1rem 0' }}>🛒 ショッピングカート</h2>

      {cart.items.length === 0 ? (
        <p style={{ color: '#666' }}>カートは空です</p>
      ) : (
        <>
          <ul style={{ listStyle: 'none', padding: 0, margin: '0 0 1rem 0' }}>
            {cart.items.map(item => (
              <li key={item.id} style={{
                padding: '0.5rem 0',
                borderBottom: '1px solid #dee2e6',
                display: 'flex',
                justifyContent: 'space-between',
                alignItems: 'center'
              }}>
                <div>
                  <div>{item.name}</div>
                  <div style={{ fontSize: '0.875rem', color: '#666' }}>
                    ¥{item.price.toLocaleString()} × {item.quantity}
                  </div>
                </div>
                <button
                  onClick={() => removeItem(item.id)}
                  style={{
                    padding: '0.25rem 0.5rem',
                    backgroundColor: '#dc3545',
                    color: 'white',
                    border: 'none',
                    borderRadius: '4px',
                    cursor: 'pointer',
                    fontSize: '0.875rem'
                  }}
                >
                  削除
                </button>
              </li>
            ))}
          </ul>

          <div style={{ borderTop: '2px solid #333', paddingTop: '1rem', marginTop: '1rem' }}>
            <p style={{ fontSize: '1.25rem', fontWeight: 'bold', margin: '0 0 1rem 0' }}>
              合計: ¥{total.toLocaleString()}
            </p>
            <button
              onClick={clearCart}
              style={{
                padding: '0.5rem 1rem',
                backgroundColor: '#6c757d',
                color: 'white',
                border: 'none',
                borderRadius: '4px',
                cursor: 'pointer',
                width: '100%'
              }}
            >
              カートをクリア
            </button>
          </div>
        </>
      )}
    </div>
  );
}

// メインコンポーネント
function Lesson04() {
  const products = [
    { id: 1, name: 'ノートPC', price: 100000 },
    { id: 2, name: 'マウス', price: 3000 },
    { id: 3, name: 'キーボード', price: 8000 },
    { id: 4, name: 'モニター', price: 30000 },
    { id: 5, name: 'ヘッドホン', price: 15000 },
    { id: 6, name: 'Webカメラ', price: 8000 },
  ];

  return (
    <CartProvider>
      <div style={{ padding: '2rem' }}>
        <h1 style={{ color: '#667eea', marginBottom: '1rem' }}>Lesson 04: 状態管理</h1>

        <p style={{ marginBottom: '2rem', color: '#666' }}>
          useReducer と Context API を使ったグローバル状態管理の例
        </p>

        <div style={{ display: 'grid', gridTemplateColumns: '2fr 1fr', gap: '2rem' }}>
          <div>
            <h2 style={{ marginBottom: '1rem' }}>商品一覧</h2>
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(200px, 1fr))', gap: '1rem' }}>
              {products.map(product => (
                <Product key={product.id} product={product} />
              ))}
            </div>
          </div>

          <div>
            <Cart />
          </div>
        </div>

        <div style={{
          backgroundColor: '#fff3cd',
          padding: '1rem',
          borderRadius: '8px',
          marginTop: '2rem'
        }}>
          <h3>💡 このレッスンで学んだこと</h3>
          <ul>
            <li>useReducer で複雑な状態を管理</li>
            <li>Context API でグローバル状態を共有</li>
            <li>カスタムフックで状態へのアクセスを簡素化</li>
            <li>Provider パターンの実装</li>
          </ul>
        </div>
      </div>
    </CartProvider>
  );
}

export default Lesson04;
