// Lesson 02: コンポーネントとProps

// 子コンポーネント: ユーザーカード
function UserCard({ name, age, email }) {
  return (
    <div style={{
      border: '1px solid #ddd',
      padding: '1rem',
      borderRadius: '8px',
      marginBottom: '1rem',
      backgroundColor: '#f8f9fa'
    }}>
      <h3 style={{ margin: '0 0 0.5rem 0' }}>{name}</h3>
      <p style={{ margin: '0.25rem 0', color: '#666' }}>年齢: {age}歳</p>
      <p style={{ margin: '0.25rem 0', color: '#666' }}>メール: {email}</p>
    </div>
  );
}

// 子コンポーネント: 商品カード
function ProductCard({ product }) {
  return (
    <div style={{
      border: '1px solid #ddd',
      padding: '1rem',
      borderRadius: '8px',
      backgroundColor: 'white'
    }}>
      <h3>{product.name}</h3>
      <p style={{ fontSize: '1.5rem', color: '#e74c3c', margin: '0.5rem 0' }}>
        ¥{product.price.toLocaleString()}
      </p>
      <button style={{
        padding: '0.5rem 1rem',
        backgroundColor: '#667eea',
        color: 'white',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer'
      }}>
        カートに追加
      </button>
    </div>
  );
}

// 親コンポーネント
function Lesson02() {
  const users = [
    { id: 1, name: '田中太郎', age: 25, email: 'tanaka@example.com' },
    { id: 2, name: '佐藤花子', age: 30, email: 'sato@example.com' },
    { id: 3, name: '鈴木一郎', age: 28, email: 'suzuki@example.com' }
  ];

  const products = [
    { id: 1, name: 'ノートPC', price: 100000 },
    { id: 2, name: 'マウス', price: 3000 },
    { id: 3, name: 'キーボード', price: 8000 }
  ];

  return (
    <div style={{ padding: '2rem' }}>
      <h1 style={{ color: '#667eea', marginBottom: '1rem' }}>Lesson 02: コンポーネントとProps</h1>

      <section style={{ marginBottom: '2rem' }}>
        <h2>ユーザーカード（Props渡し）</h2>
        {users.map(user => (
          <UserCard
            key={user.id}
            name={user.name}
            age={user.age}
            email={user.email}
          />
        ))}
      </section>

      <section style={{ marginBottom: '2rem' }}>
        <h2>商品カード（オブジェクトをProps渡し）</h2>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(200px, 1fr))', gap: '1rem' }}>
          {products.map(product => (
            <ProductCard key={product.id} product={product} />
          ))}
        </div>
      </section>

      <div style={{
        backgroundColor: '#fff3cd',
        padding: '1rem',
        borderRadius: '8px',
        marginTop: '2rem'
      }}>
        <h3>💡 このレッスンで学んだこと</h3>
        <ul>
          <li>コンポーネントの作成と再利用</li>
          <li>Propsでデータを親から子へ渡す</li>
          <li>配列データをmap()で表示</li>
          <li>オブジェクト全体をPropsとして渡す</li>
        </ul>
      </div>
    </div>
  );
}

export default Lesson02;
