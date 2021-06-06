import {AuthGuardService} from "./auth.guard.service";

describe('AuthGuardService', () => {
  let service: AuthGuardService;

  beforeEach(() => {
    // @ts-ignore
    service = new AuthGuardService();
  });

  it('should not authenticated', function () {
    sessionStorage.clear();
    let data = service.isAuthenticated();

    expect(data).toBeFalsy();
  });

  it('should be authenticated', function () {
    sessionStorage.setItem('access_token', 'Token');
    let data = service.isAuthenticated();

    expect(data).toBeTruthy();
  });
});
