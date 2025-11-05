# Lesson 02: コンポーネントとProps

## 🎯 学習目標

- Propsの概念を理解する
- 親コンポーネントから子コンポーネントへデータを渡す
- Childrenプロパティの使い方を学ぶ
- コンポーネントの再利用性を高める

## 📖 概要

Propsは、コンポーネント間でデータを受け渡すための仕組みです。親コンポーネントから子コンポーネントへ一方向にデータを渡すことで、再利用可能なコンポーネントを作成できます。

## 💻 Propsの基本

### Propsを受け取る

```jsx
// src/components/Greeting.js
function Greeting(props) {
  return <h1>こんにちは、{props.name}さん！</h1>;
}

export default Greeting;
```

```jsx
// src/App.js
import Greeting from './components/Greeting';

function App() {
  return (
    <div>
      <Greeting name="太郎" />
      <Greeting name="花子" />
      <Greeting name="一郎" />
    </div>
  );
}

export default App;
```

### 分割代入

```jsx
// より簡潔な書き方
function Greeting({ name }) {
  return <h1>こんにちは、{name}さん！</h1>;
}

export default Greeting;
```

### 複数のProps

```jsx
// src/components/UserCard.js
function UserCard({ name, age, email }) {
  return (
    <div style={{ border: '1px solid #ddd', padding: '20px', margin: '10px' }}>
      <h2>{name}</h2>
      <p>年齢: {age}歳</p>
      <p>メール: {email}</p>
    </div>
  );
}

export default UserCard;
```

```jsx
// src/App.js
import UserCard from './components/UserCard';

function App() {
  return (
    <div>
      <UserCard name="田中太郎" age={25} email="tanaka@example.com" />
      <UserCard name="佐藤花子" age={30} email="sato@example.com" />
    </div>
  );
}
```

## 🎨 オブジェクトとして渡す

```jsx
// src/components/ProductCard.js
function ProductCard({ product }) {
  return (
    <div style={{ border: '1px solid #ddd', padding: '15px', width: '250px' }}>
      <img src={product.image} alt={product.name} style={{ width: '100%' }} />
      <h3>{product.name}</h3>
      <p>{product.description}</p>
      <p style={{ fontSize: '24px', color: '#e74c3c' }}>
        ¥{product.price.toLocaleString()}
      </p>
    </div>
  );
}

export default ProductCard;
```

```jsx
// src/App.js
import ProductCard from './components/ProductCard';

function App() {
  const product = {
    name: 'ノートPC',
    price: 100000,
    description: '高性能なノートパソコン',
    image: 'https://via.placeholder.com/200'
  };
  
  return (
    <div>
      <ProductCard product={product} />
    </div>
  );
}
```

## 📦 配列データの表示

```jsx
// src/components/ProductList.js
import ProductCard from './ProductCard';

function ProductList({ products }) {
  return (
    <div style={{ display: 'flex', flexWrap: 'wrap', gap: '20px' }}>
      {products.map((product) => (
        <ProductCard key={product.id} product={product} />
      ))}
    </div>
  );
}

export default ProductList;
```

```jsx
// src/App.js
import ProductList from './components/ProductList';

function App() {
  const products = [
    { id: 1, name: 'ノートPC', price: 100000, description: '高性能', image: 'https://via.placeholder.com/200' },
    { id: 2, name: 'マウス', price: 3000, description: 'ワイヤレス', image: 'https://via.placeholder.com/200' },
    { id: 3, name: 'キーボード', price: 8000, description: 'メカニカル', image: 'https://via.placeholder.com/200' },
  ];
  
  return (
    <div style={{ padding: '20px' }}>
      <h1>商品一覧</h1>
      <ProductList products={products} />
    </div>
  );
}

export default App;
```

## 👶 Children Props

```jsx
// src/components/Card.js
function Card({ title, children }) {
  return (
    <div style={{ 
      border: '1px solid #ddd', 
      borderRadius: '8px', 
      padding: '20px',
      margin: '10px'
    }}>
      <h2>{title}</h2>
      <div>{children}</div>
    </div>
  );
}

export default Card;
```

```jsx
// src/App.js
import Card from './components/Card';

function App() {
  return (
    <div>
      <Card title="お知らせ">
        <p>新機能がリリースされました！</p>
        <button>詳細を見る</button>
      </Card>
      
      <Card title="ユーザー情報">
        <p>名前: 田中太郎</p>
        <p>メール: tanaka@example.com</p>
      </Card>
    </div>
  );
}
```

## 🎯 デフォルトProps

```jsx
// src/components/Button.js
function Button({ text = 'クリック', color = 'blue', onClick }) {
  return (
    <button
      onClick={onClick}
      style={{
        padding: '10px 20px',
        backgroundColor: color,
        color: 'white',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer'
      }}
    >
      {text}
    </button>
  );
}

export default Button;
```

```jsx
// src/App.js
import Button from './components/Button';

function App() {
  return (
    <div>
      <Button />
      <Button text="送信" color="green" />
      <Button text="削除" color="red" onClick={() => alert('削除しました')} />
    </div>
  );
}
```

## 📝 演習問題

### 問題1: ブログ記事コンポーネント

以下のプロパティを受け取る `BlogPost` コンポーネントを作成してください：
- title (タイトル)
- author (著者)
- date (日付)
- content (本文)

### 問題2: ユーザーリスト

ユーザーの配列を受け取り、それぞれを表示する `UserList` コンポーネントを作成してください。

### 問題3: アラートボックス

`type` プロパティに応じて色が変わるアラートコンポーネントを作成してください：
- success: 緑
- warning: 黄
- error: 赤

## ✅ 解答例

### 問題1の解答

```jsx
// src/components/BlogPost.js
function BlogPost({ title, author, date, content }) {
  return (
    <article style={{ 
      border: '1px solid #ddd', 
      padding: '20px', 
      margin: '20px 0',
      borderRadius: '8px'
    }}>
      <h2>{title}</h2>
      <div style={{ color: '#666', marginBottom: '10px' }}>
        <span>著者: {author}</span>
        <span style={{ marginLeft: '20px' }}>日付: {date}</span>
      </div>
      <p>{content}</p>
    </article>
  );
}

export default BlogPost;
```

```jsx
// 使用例
<BlogPost 
  title="Reactの学習"
  author="田中太郎"
  date="2024-01-15"
  content="Reactは素晴らしいライブラリです。"
/>
```

### 問題2の解答

```jsx
// src/components/UserList.js
function UserList({ users }) {
  return (
    <div>
      <h2>ユーザー一覧</h2>
      <ul style={{ listStyle: 'none', padding: 0 }}>
        {users.map((user) => (
          <li key={user.id} style={{ 
            padding: '10px', 
            margin: '5px 0', 
            border: '1px solid #ddd',
            borderRadius: '4px'
          }}>
            <strong>{user.name}</strong> - {user.email}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default UserList;
```

```jsx
// 使用例
const users = [
  { id: 1, name: '田中太郎', email: 'tanaka@example.com' },
  { id: 2, name: '佐藤花子', email: 'sato@example.com' },
];

<UserList users={users} />
```

### 問題3の解答

```jsx
// src/components/Alert.js
function Alert({ type = 'info', children }) {
  const colors = {
    success: '#d4edda',
    warning: '#fff3cd',
    error: '#f8d7da',
    info: '#d1ecf1'
  };
  
  const textColors = {
    success: '#155724',
    warning: '#856404',
    error: '#721c24',
    info: '#0c5460'
  };
  
  return (
    <div style={{
      padding: '15px',
      margin: '10px 0',
      backgroundColor: colors[type],
      color: textColors[type],
      borderRadius: '4px',
      border: `1px solid ${textColors[type]}`
    }}>
      {children}
    </div>
  );
}

export default Alert;
```

```jsx
// 使用例
<Alert type="success">データが保存されました！</Alert>
<Alert type="warning">注意が必要です</Alert>
<Alert type="error">エラーが発生しました</Alert>
```

## 🎓 まとめ

- Propsでコンポーネント間のデータ受け渡しができます
- Propsは読み取り専用（イミュータブル）です
- Childrenプロパティでコンポーネントをラップできます
- デフォルト値で柔軟なコンポーネントを作成できます

次のレッスンでは、useStateフックを使った状態管理を学びます。

## 📚 参考リンク

- [React Props](https://react.dev/learn/passing-props-to-a-component)
