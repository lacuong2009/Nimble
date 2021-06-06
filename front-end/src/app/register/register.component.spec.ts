import {async, ComponentFixture, TestBed} from '@angular/core/testing';
import {AppComponent} from "../app.component";
import {ActivatedRoute, Router} from "@angular/router";
import {HttpClientModule} from "@angular/common/http";
import {ToastrModule} from "ngx-toastr";
import {BrowserDynamicTestingModule} from "@angular/platform-browser-dynamic/testing";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {BrowserModule} from "@angular/platform-browser";
import {RegisterComponent} from "./register.component";

describe('AuthComponent', () => {
  let comp: RegisterComponent;
  let fixture: ComponentFixture<RegisterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [
        AppComponent,
        RegisterComponent
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
                  return '/register';
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
      const fixture = TestBed.createComponent(RegisterComponent);
      comp = fixture.componentInstance;
    });
  }));

  it('should create the RegisterComponent', async(() => {
    expect(comp).toBeTruthy();
  }));

  it('should set submitted to false', async(() => {
    expect(comp.submitted).toBeFalsy();
  }));

  it('form Register should be invalid', async(() => {
    comp.form.controls['name'].setValue(null);
    comp.form.controls['email'].setValue(null);
    comp.form.controls['password'].setValue(null);
    comp.form.controls['rpassword'].setValue(null);

    expect(comp.form.valid).toBeFalsy();
  }));

  it('form Register should be valid', async(() => {
    comp.form.controls['name'].setValue('test');
    comp.form.controls['email'].setValue('a@a.se');
    comp.form.controls['password'].setValue('123123');
    comp.form.controls['rpassword'].setValue('123123');

    expect(comp.form.valid).toBeTruthy();
  }));
});
