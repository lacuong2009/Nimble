<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laminas\Diactoros\Response as Psr7Response;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AccessTokenController
 * @package App\Http\Controllers
 */
class AccessTokenController extends Controller
{
    use HandlesOAuthErrors;

    /**
     * The authorization server.
     *
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    protected $server;

    /**
     * The token repository instance.
     *
     * @var \Laravel\Passport\TokenRepository
     */
    protected $tokens;

    /**
     * The JWT parser instance.
     *
     * @var \Lcobucci\JWT\Parser
     */
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @param  \League\OAuth2\Server\AuthorizationServer  $server
     * @param  \Laravel\Passport\TokenRepository  $tokens
     * @param  \Lcobucci\JWT\Parser  $jwt
     * @return void
     */
    public function __construct(AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt)
    {
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;
    }

    /**
     * @OA\Post(
     *     path="/oauth/token",
     *     tags={"User"},
     *     description="Login",
     *     @OA\RequestBody(
     *          description="Input data format",
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      property="token_type",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                       property="client_id",
     *                       type="string"
     *                  ),
     *                  @OA\Property(
     *                       property="client_secret",
     *                       type="string"
     *                  ),
     *                  @OA\Property(
     *                       property="username",
     *                       type="string"
     *                  ),
     *                  @OA\Property(
     *                       property="password",
     *                       type="string"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Token",
     *          @OA\JsonContent(
     *                  type="object",
     *                  @OA\Property(
     *                      property="token_type",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                       property="expires_in",
     *                       type=""
     *                  ),
     *                  @OA\Property(
     *                       property="access_token",
     *                       type="string"
     *                  ),
     *                  @OA\Property(
     *                       property="refresh_token",
     *                       type="string"
     *                  )
     *          )
     *     )
     * )
     *
     * Authorize a client to access the user's account.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response)
            );
        });
    }
}
