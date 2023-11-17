<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Регистрация",
 *      tags={"Авторизация"},
 *      description="Регистрация пользователя по email, имени и телефону",
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                  @OA\Property(property="name", type="text",example="Иван"),
 *                  @OA\Property(property="email", type="text",example="example@example.com"),
 *                  @OA\Property(property="phone", type="text",example="+79885676746"),
 *                  ),
 *             },
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *      @OA\Response(
 *         response=401,
 *         description="Ошибка при регистрации, смотреть массив с ошибками ERRORS",
 *     ),
 *      @OA\Response(
 *         response=500,
 *         description="Ошибка сервера",
 *     ),
 * ),
 * @OA\Post(
 *     path="/api/login",
 *     summary="Вход",
 *      tags={"Авторизация"},
 *      description="Авторизация пользователя по email и автоматически сгенерированному паролю",
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                  @OA\Property(property="email", type="text",example="example@example.com"),
 *                  @OA\Property(property="password", type="text",example="examp12345"),
 *                  ),
 *             },
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *       @OA\Response(
 *         response=401,
 *         description="Ошибка при входе, смотреть массив с ошибками ERRORS",
 *     ),
 *      @OA\Response(
 *         response=500,
 *         description="Ошибка сервера",
 *     ),
 * ),
 */

class LoginController extends Controller
{
    //
}
