import { useState } from 'react';
import './App.css';

// レッスンコンポーネントのインポート
import Lesson01 from './lessons/Lesson01';
import Lesson02 from './lessons/Lesson02';
import Lesson03 from './lessons/Lesson03';
import Lesson04 from './lessons/Lesson04';
import Lesson05 from './lessons/Lesson05';

function App() {
  const [currentLesson, setCurrentLesson] = useState('home');

  const renderLesson = () => {
    switch (currentLesson) {
      case 'lesson01': return <Lesson01 />;
      case 'lesson02': return <Lesson02 />;
      case 'lesson03': return <Lesson03 />;
      case 'lesson04': return <Lesson04 />;
      case 'lesson05': return <Lesson05 />;
      default:
        return (
          <div style={{ 
            padding: '3rem 2rem',
            background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            minHeight: 'calc(100vh - 200px)',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center'
          }}>
            <div style={{
              background: 'white',
              borderRadius: '16px',
              padding: '3rem',
              maxWidth: '900px',
              width: '100%',
              boxShadow: '0 20px 60px rgba(0,0,0,0.3)'
            }}>
              <div style={{ textAlign: 'center', marginBottom: '3rem' }}>
                <h1 style={{ 
                  fontSize: '3rem',
                  background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                  WebkitBackgroundClip: 'text',
                  WebkitTextFillColor: 'transparent',
                  backgroundClip: 'text',
                  marginBottom: '0.5rem'
                }}>
                  🎉 React レッスン
                </h1>
                <p style={{ fontSize: '1.2rem', color: '#666' }}>
                  段階的に学ぶReactフレームワーク
                </p>
              </div>

              <div style={{
                display: 'grid',
                gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))',
                gap: '1.5rem',
                marginBottom: '2rem'
              }}>
                {[
                  { num: '01', title: 'React基礎とJSX', desc: 'JSXの基本文法と変数表示、配列のマッピングを学習', lesson: 'lesson01' },
                  { num: '02', title: 'コンポーネントとProps', desc: 'コンポーネントの作成とPropsでのデータ受け渡し', lesson: 'lesson02' },
                  { num: '03', title: 'フック', desc: 'useState、useEffectを使った状態管理', lesson: 'lesson03' },
                  { num: '04', title: '状態管理', desc: 'useReducerとContext APIでグローバル状態管理', lesson: 'lesson04' },
                  { num: '05', title: 'API連携', desc: 'fetchを使った外部APIとのデータ通信', lesson: 'lesson05' }
                ].map(item => (
                  <div
                    key={item.num}
                    onClick={() => setCurrentLesson(item.lesson)}
                    style={{
                      background: 'linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)',
                      borderRadius: '12px',
                      padding: '2rem',
                      cursor: 'pointer',
                      transition: 'all 0.3s ease',
                      border: '2px solid transparent'
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.transform = 'translateY(-5px)';
                      e.currentTarget.style.boxShadow = '0 10px 30px rgba(0,0,0,0.2)';
                      e.currentTarget.style.borderColor = '#667eea';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.transform = 'translateY(0)';
                      e.currentTarget.style.boxShadow = 'none';
                      e.currentTarget.style.borderColor = 'transparent';
                    }}
                  >
                    <div style={{
                      fontSize: '2.5rem',
                      fontWeight: 'bold',
                      background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                      WebkitBackgroundClip: 'text',
                      WebkitTextFillColor: 'transparent',
                      backgroundClip: 'text',
                      marginBottom: '0.5rem'
                    }}>
                      {item.num}
                    </div>
                    <div style={{
                      fontSize: '1.2rem',
                      fontWeight: 'bold',
                      marginBottom: '0.5rem',
                      color: '#333'
                    }}>
                      {item.title}
                    </div>
                    <div style={{
                      fontSize: '0.9rem',
                      color: '#666',
                      lineHeight: '1.5'
                    }}>
                      {item.desc}
                    </div>
                  </div>
                ))}
              </div>

              <div style={{
                background: '#e7f3ff',
                borderLeft: '4px solid #667eea',
                padding: '1rem',
                borderRadius: '8px'
              }}>
                <h3 style={{ color: '#667eea', marginBottom: '0.5rem' }}>💡 学習の進め方</h3>
                <ul style={{ marginLeft: '1.5rem', color: '#666' }}>
                  <li>上のナビゲーションまたはカードをクリックして各レッスンへ</li>
                  <li><code>src/lessons/</code> フォルダでコンポーネントのコードを確認</li>
                  <li>実際に動作を確認しながらReactの機能を理解</li>
                  <li>各レッスンフォルダのREADME.mdで詳細を学習</li>
                </ul>
              </div>
            </div>
          </div>
        );
    }
  };

  return (
    <div className="App">
      <nav style={{
        background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        padding: '1rem',
        boxShadow: '0 2px 4px rgba(0,0,0,0.1)'
      }}>
        <div style={{ maxWidth: '1200px', margin: '0 auto', display: 'flex', gap: '1rem', flexWrap: 'wrap' }}>
          <button onClick={() => setCurrentLesson('home')} style={buttonStyle}>ホーム</button>
          <button onClick={() => setCurrentLesson('lesson01')} style={buttonStyle}>Lesson 01</button>
          <button onClick={() => setCurrentLesson('lesson02')} style={buttonStyle}>Lesson 02</button>
          <button onClick={() => setCurrentLesson('lesson03')} style={buttonStyle}>Lesson 03</button>
          <button onClick={() => setCurrentLesson('lesson04')} style={buttonStyle}>Lesson 04</button>
          <button onClick={() => setCurrentLesson('lesson05')} style={buttonStyle}>Lesson 05</button>
        </div>
      </nav>

      <main style={{ maxWidth: '1200px', margin: '0 auto' }}>
        {renderLesson()}
      </main>

      <footer style={{
        background: '#333',
        color: 'white',
        textAlign: 'center',
        padding: '1.5rem',
        marginTop: '2rem'
      }}>
        <p>&copy; 2024 React レッスンプロジェクト</p>
      </footer>
    </div>
  );
}

const buttonStyle = {
  padding: '0.5rem 1rem',
  background: 'rgba(255, 255, 255, 0.2)',
  color: 'white',
  border: 'none',
  borderRadius: '4px',
  cursor: 'pointer',
  fontSize: '1rem',
  transition: 'background 0.3s'
};

export default App;
