import axios from 'axios'
import { useState, useEffect } from 'react'

const baseURL = 'http://localhost:8123/api'

function App() {

  const [products, setProducts] = useState(null)

  const access_token = "4|dKhAS4GG87e4eypCpu4FK9QzO9LUse1z371TKwcL"
  const config = {
    headers: {
      'Authorization': `Bearer ${access_token}`
    }
  }
  
  useEffect(() => {
    axios.get(baseURL + '/products', config).then((res) => {
      setProducts(res.data)
    })
  }, [])

  if (!products) return null
  return (
    <>
      <h1>Product List ({products.length})</h1>
      <table border="1">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>ProductName</th>
            <th>UnitPrice</th>
            <th>Slug</th>
            <th>CreateDate</th>
            <th>ModifiedDate</th>
          </tr>
        </thead>
        <tbody>
          {
            products.map(element => {
              return (
                <tr key={element.id}>
                  <td>{element.id}</td>
                  <td><img src={element.image} width="100" />
                  </td>
                  <td>{element.name}</td>
                  <td>{element.price}</td>
                  <td>{element.slug}</td>
                  <td>{element.created_at}</td>
                  <td>{element.updated_at}</td>
                </tr>
              )
            })
          }
        </tbody>

      </table>
    </>
  )
}

export default App;