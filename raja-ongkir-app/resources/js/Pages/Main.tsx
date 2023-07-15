import React, { useState } from 'react'
import { Inertia } from '@inertiajs/inertia'
import route from 'ziggy-js'
import { MainLayout } from '@/Layouts/MainLayout'
import { Link } from '@inertiajs/inertia-react'

export default function Main() {
    const [destination, setDestination] = useState('')
    const [results, setResults] = useState([])

    const [valid, setValid] = useState(false)
    const [loading, setLoading] = useState(false)

    const handleSubmit = (e: any) => {
        e.preventDefault()

        if (!destination) {
            setValid(true)

            return
        }

        Inertia.post(route("cek-ongkir"), { destination }, {
            forceFormData: true,
            onProgress: () => {
                setLoading(true)
            },
            onFinish: () => {
                setLoading(false)
            },
            onSuccess: (response: any) => {
                setResults(response.props.results)
                setValid(false)
                setLoading(false)
            },
            onError: (error) => {
                console.error(error.message)
                setValid(false)
                setLoading(false)
            },
        })
    }

    return (
        <MainLayout title="Main Page">
            
            <section id="main-page" className="my-10 container">

                <div className="card w-96 bg-base-200 border-solid border-2 border-purple-400 shadow-xl mx-auto">
                    <h1 className="text-center text-xl font-bold my-4">Check Ongkir</h1>

                    <div className="card-body">
                        <form onSubmit={handleSubmit}>

                            <div className="form-control mb-4">
                                <label className="label">
                                    <span className="label-text">Masukan ID kota</span>
                                </label>

                                <input type="text" placeholder="Kota Tujuan" className="input input-bordered my-4" name="destination" onChange={(e) => setDestination(e.target.value)} value={destination} disabled={loading} />
                                { valid && <span className="text-red-500 font-bold mb-4">Destination is Required</span> }

                                <button className={`btn btn-primary mb-4 ${loading ? "loading" : ""}`} type="submit">Register</button>
                                { results.length > 0 && <Link href={route("main-page")} className={`btn btn-error mb-4 ${loading ? "hidden" : ""}`}>Clear</Link> }
                            </div>

                        </form>
                    </div>
                </div>

                { results.length > 0 && (
                    <div className="card w-96 bg-primary text-primary-content shadow-xl mx-auto mt-8">
                        <div className="card-body">
                            <h2 className="card-title mb-4">Hasil Cek Ongkir</h2>

                            { results.map((result: any, index: number) => (
                                <div key={index} className="mb-4">
                                    <h3>{result.name}</h3>
                                    <ul>
                                        { result.costs.map((cost: any, i: number) => (
                                            <li key={i}>
                                                <strong>{cost.service}</strong>: Rp . {cost.cost[0].value} - {cost.cost[0].etd}
                                            </li>
                                        )) }
                                    </ul>
                                </div>
                            )) }
                        </div>
                    </div>
                ) }

                
            </section>

        </MainLayout>
    )
}
