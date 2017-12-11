<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Configuracion;
use PHPMailer\PHPMailer\PHPMailer;
use Intervention\Image\Facades\Image;

class ConfiguracionController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function login(Request $request)
    {
        $this->validate($request, [
            'usuario' => 'required',
            'pwd' => 'required'
        ]);
        $user = $request->input("usuario");
        $pwd = $request->input("pwd");

        $results = DB::table('configuraciones')->select('usuario')->where([
            ['usuario','=',$user] ,
            ['pwd','=',md5($pwd)]
        ])->get();


        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $results
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');

    }//login()

    public function setConfig(Request $request){
        /*$this->validate($request, [
            'consultorio' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'horario' => 'required'
        ]);*/
        $conf = Configuracion::find(1);
        $nombre = $request->input('consultorio')?$request->input('consultorio'):$conf->consultorio;
        $usuario = $request->input('usuario')?$request->input('usuario'):$conf->usuario;
        $telefono = $request->input('telefono')?$request->input('telefono'):$conf->telefono;
        $direccion = $request->input('direccion')?$request->input('direccion'):$conf->direccion;
        $horario = $request->input('horario')?$request->input('horario'):$conf->horario;
        $email = $request->input('email')?$request->input('email'):$conf->email;
        $pwd_email = $request->input('pwd_email')?$request->input('pwd_email'):$conf->pwd_email;

            if($request->hasFile("logo") && $request->file("logo")->isValid() == false){
                return response()->json([
                    "status" => "bad",
                    "code" => 400,
                    "message" => "Parametro incorrecto, error al subir el logo",
                    "result"  => []
                ],400)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
            }//retorna error solo cuando se sube la imagen/file y algo salio mal pero no es obligatorio subirla
         
        $ruta = $conf->logo;
        if($request->hasFile("logo") && $request->file("logo")->isValid() ){

            if ($ruta != null || $ruta != '' ){
                if (unlink(base_path('public/'.$conf->logo))) {
                    $path = base_path("public/imagenes/");
                    $filename = "logo.".$request->file('logo')->getClientOriginalExtension();
                    $request->file("logo")->move($path , $filename);
                    $ruta = "imagenes/".$filename;
                }
            }else{
                $path = base_path("public/imagenes/");
                $filename = "logo.".$request->file('logo')->getClientOriginalExtension();
                $request->file("logo")->move($path , $filename);
                $ruta = "imagenes/".$filename;
            }


        }//subimos el logo al server


        $conf->consultorio = $nombre;
        $conf->usuario = $usuario;
        $conf->telefono = $telefono;
        $conf->direccion = $direccion;
        $conf->horario = $horario;
        $conf->logo = $ruta;
        $conf->email = $email;
        $conf->pwd_email = $pwd_email;
        $conf->save();

        return response()->json([
            "status" => "ok",
            "code" => 200,
            "result" => "Se Actualizo Correctamente"
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');
    }//setConfig()

    public function getConfig(){
        $conf = Configuracion::find(1);
        if ($conf->logo != null || $conf->logo != ''){
            $foto =(string) Image::make(base_path('public/'.$conf->logo))->encode("data-url");
            $conf->logo =$foto;
        }
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $conf
        ],200)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Content-Type', 'application/json');
    }//getConfig()

    public function changePassword(Request $request){
        $this->validate($request, [
            'pwd' => 'required',
        ]);
        $new = $request->input('pwd');
        $conf = \App\Configuracion::find(1);
        $conf->pwd = md5($new);
        $conf->save();

        return response()->json([
            "status" => "ok",
            "code" => 200,
            "result" => "Se Actualizo Correctamente"
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//changePassword

    public function changePasswordLogin(Request $request){
        #talves agregar un render de un mensaje que indique que debe ingresar contraseña
        $new = $request->input('pwd');
        $conf = \App\Configuracion::find(1);
        $conf->pwd = md5($new);
        $conf->save();

        return redirect('http://104.131.121.55:8080')->header('Access-Control-Allow-Origin','*');
    }//changePassword

    public function forgotPassword(){
        $mail = new PHPMailer(true);
        $config = Configuracion::find(1);
        try {

            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "tls"; // or ssl
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = $config->email ;
            $mail->Password = $config->pwd_email;
            $mail->setFrom($config->email , $config->consultorio?'Nutrimental':$config->consultorio);
            $mail->Subject = "Recuperar Contraseña";
            $mail->MsgHTML('<form  action="http://104.131.121.55/changePasswordLogin" method="post">
                <div style="text-align: center; background-color: darkorange;"><br><label style="color:white;"><strong>Capture la nueva contraseña para su cuenta de administrador:</strong></label><br><br>
                <input type="password" required style="width: 50%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #cc;border-radius: 4px;box-sizing: border-box;" placeholder="Nueva Contraseña" id="pwd" name="pwd">
                <br><br>
                <button type="submit" style="background-color: #4CAF50;width: 50%;color:white;padding:14px 20px;margin:8px 0;border:none;-webkit-border-radius: 4px;cursor:hand;;-moz-border-radius: 4px;cursor:hand;;border-radius: 4px;cursor:hand;;">Recuperar</button>
            </form></div>');
            $mail->addAddress($config->email, $config->consultorio?'Nutrimental':$config->consultorio);
            $mail->send();

            return response()->json([
                "status" => "ok",
                "code" => 200,
                "result" => 'Se envio un correo para cambiar la contraseña'
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');

        } catch (phpmailerException $e) {
            return response()->json([
                "status" => "fail",
                "code" => 400,
                "result" => "Error al mandar el correo"
            ],400)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return response()->json([
                "status" => "fail",
                "code" => 400,
                "result" => "Error al mandar el correo"
            ],400)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }


    }//olvido contraseña

}//Configuracion

