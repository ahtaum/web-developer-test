### Install
type in **console** or **terminal** :
- `npm i` or npm `install`
- composer install and composer update

### config
setting your key rajaOngkir in  `app/Http/Controllers/MainController.php` inside in **cekOngkir** method :

    public  function  cekOngkir(Request  $request) {
    
    $request->validate([
    
    'destination'  =>  'required',
    
    ]);
    
      
    
    $destination = $request->input('destination');
    
    $response = Http::withHeaders([
    
    'key'  =>  'ea2e3cd4f01033afef7118669f77ff02',
    
    ])->post('https://api.rajaongkir.com/starter/cost', [
    
    'origin'  =>  '501',
    
    'destination'  =>  $destination,
    
    'weight'  =>  1000,
    
    'courier'  =>  'jne',
    
    ]);
    
      
    
    $data = $response->json();
    
    $results = $data['rajaongkir']['results'];
    
      
    
    return  Inertia::render('Main', compact('results'));
    
    }

### Run App
type in console or terminal :

`npm run dev` and `php artisan serve` this will running frontend and backend, 

**Notes : Make sure that both commands are executed without fail.**