<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="GUG Apis ",
 *     version="1.0.0",
 *     @OA\Contact(
 *         name="Yosof Bayan",
 *         url="https://wa.me/+963967213544",
 *         email="yosofbayan75@gmail.com"
 *     ),
 * )
 * @OA\Server(
 *     url="http://127.0.0.1:8000/api/v1",
 *     description="local Base URL"
 * )
 * @OA\Server(
 *     url="http://gug-back.icrcompany.net/api/v1",
 *     description="Develop Base URL"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 * @OA\Components(
 *         @OA\Header(
 *             header="Accept",
 *     description="Header indicating the expected response format. Should be set to 'application/json'.",
 *     required=true,
 *     @OA\Schema(type="string", default="application/json"),
 *
 *         ),
 *
 *     )
 *
 */


//Admin apis
abstract class Controller
{
    //
}
