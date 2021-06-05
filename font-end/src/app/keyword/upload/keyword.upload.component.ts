import {AfterViewInit, Component, Input, OnInit} from "@angular/core";
import {KeywordService} from "../keyword.service";
import {NgbActiveModal} from "@ng-bootstrap/ng-bootstrap";
import {ToastrService} from "ngx-toastr";

@Component({
  selector: 'app-upload-details',
  templateUrl: './keyword.upload.component.html',
  styleUrls: ['./keyword.upload.component.scss']
})
export class KeywordUploadComponent implements OnInit, AfterViewInit{
  @Input() name: string = '';
  public formData: FormData = new FormData();

  constructor(private keywordService: KeywordService,
              public activeModal: NgbActiveModal,
              private toastr: ToastrService) {
  }

  ngAfterViewInit(): void {

  }

  ngOnInit(): void {
  }

  public import() {
    this.keywordService.postFile(this.formData).subscribe(
      (response: any) => {
        this.toastr.success('Import successfully', 'SUCCESS');
        this.activeModal.close();
      },
      (error: any) => {
        this.toastr.error('Import failed', 'ERROR');
      }
    );
  }

  public handleFileInput(event: any) {
    let fileList: FileList = event.target.files;

    if (fileList.length > 0) {
      let file: File = fileList[0];
      this.formData.append('File', file, file.name);
    }
  }
}
