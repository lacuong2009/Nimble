import {RegisterService} from "./register.service";
import {of} from "rxjs";

describe('RegisterService', () => {
  let registerSpy: any;
  let registerService: any;

  beforeEach(() => {
    // @ts-ignore
    registerService = jasmine.createSpyObj('RegisterService', ['register']);
    console.log(registerService.register);
    registerSpy = registerService.register.and.returnValue(of('test'));
  });

  it('should register success', function () {
    expect(registerService.register).toBeTruthy();
    console.log(registerSpy.calls.any());
    expect(registerSpy.calls.any()).toBe(false);

  });
});

