import {async, ComponentFixture, TestBed} from '@angular/core/testing';
import {AppComponent} from "../app.component";
import {ActivatedRoute, Router} from "@angular/router";
import {HttpClientModule} from "@angular/common/http";
import {ToastrModule} from "ngx-toastr";
import {BrowserDynamicTestingModule} from "@angular/platform-browser-dynamic/testing";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {BrowserModule, By} from "@angular/platform-browser";
import {KeywordComponent} from "./keyword.component";

describe('KeywordComponent', () => {
  let comp: KeywordComponent;
  let fixture: ComponentFixture<KeywordComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [
        AppComponent,
        KeywordComponent
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
      fixture = TestBed.createComponent(KeywordComponent);
      comp = fixture.componentInstance;
    });
  }));

  it('should create the KeywordComponent', async(() => {
    expect(comp).toBeTruthy();
  }));

  it('should have a data table', async(() => {
    let el = fixture.debugElement.query(By.css('table')).nativeElement;
    expect(el).toBeTruthy();
  }));

  it('should call button refresh', async(() => {
    let el = fixture.debugElement.query(By.css('button[name=refresh]')).nativeElement;
    expect(el).toBeTruthy();
    el.click();
  }));

  it('should call button upload', async(() => {
    let el = fixture.debugElement.query(By.css('button[name=upload]')).nativeElement;
    expect(el).toBeTruthy();
    el.click();
  }));
});
