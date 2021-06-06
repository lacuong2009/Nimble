import {async, TestBed} from '@angular/core/testing';
import {AppComponent} from "../app.component";
import {AuthComponent} from "./auth.component";
import {ActivatedRoute, Router} from "@angular/router";
import {HttpClientModule} from "@angular/common/http";
import {ToastrModule} from "ngx-toastr";
import {BrowserDynamicTestingModule} from "@angular/platform-browser-dynamic/testing";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {BrowserModule} from "@angular/platform-browser";

describe('AuthComponent', () => {
  let comp: AuthComponent;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [
        AppComponent,
        AuthComponent
      ],
      imports: [
        HttpClientModule,
        BrowserDynamicTestingModule,
        ToastrModule.forRoot({
          positionClass: 'toast-bottom-right'
        }),
        FormsModule,
        ReactiveFormsModule,
        BrowserModule
      ],
      providers: [
        {
          provide: ActivatedRoute,
          useValue: {
            snapshot: {
              paramMap: {
                get(): string {
                  return '123';
                },
              },
            },
          }
        },
        {
          provide: Router,
          useValue: {}
        }
      ]
    }).compileComponents().then(() => {
      // @ts-ignore
      const fixture = TestBed.createComponent(AuthComponent);
      comp = fixture.componentInstance;
    });
  }));

  it('should create the AuthComponent', async(() => {
    expect(comp).toBeTruthy();
  }));

  it('should set submitted to false', async(() => {
    expect(comp.submitted).toBeFalsy();
  }));

  it('form should be invalid', async(() => {
    comp.form.controls['username'].setValue(null);
    comp.form.controls['password'].setValue(null);
    expect(comp.form.valid).toBeFalsy();
  }));

  it('form should be valid', async(() => {
    comp.form.controls['username'].setValue('test@hotmail.com');
    comp.form.controls['password'].setValue('123123');
    expect(comp.form.valid).toBeTruthy();
  }));
});
