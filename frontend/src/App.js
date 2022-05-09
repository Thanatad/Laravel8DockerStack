import axios from 'axios'
import { useState, useEffect } from 'react'

const baseURL = 'http://localhost:8123/api'
const verApi = 'v2'
function App() {

  const [products, setProducts] = useState(null)

  const access_token = "5|CkQKh9k8YLOmifWc0kWzAKQtoqSWt2ahXUbRX1vi"
  const config = {
    headers: {
      'Authorization': `Bearer ${access_token}`
    }
  }

  useEffect(() => {
    axios.get(`${baseURL}/${verApi}/products`, config).then((res) => {
      setProducts(res.data.results)
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
            <th>User Create</th>
            <th>Image</th>
            <th>ProductName</th>
            <th>UnitPrice</th>
            <th>Slug</th>
            <th>CreateDate</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          {
            products.map(element => {
              return (
                <tr key={element.id}>
                  <td>{element.id}</td>
                  <td>{element.user.fullname}</td>
                  <td><img src={element.image} width="100" />
                  </td>
                  <td>{element.name}</td>
                  <td>{element.price}</td>
                  <td>{element.slug}</td>
                  <td>{element.created_at.date_time}</td>
                  <td>{element.description}</td>
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