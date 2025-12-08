// script.js - validation کلاینت‌ساید و نمایش فیلدهای Other

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrationForm");

  // عناصر Other
  const germanLevelRadios = document.querySelectorAll(
    'input[name="german_level"]'
  );
  const germanLevelOther = document.getElementById("german_level_other");

  const booksCheckboxes = document.querySelectorAll('input[name="books[]"]');
  const booksOther = document.getElementById("books_other");

  const howFoundRadios = document.querySelectorAll('input[name="how_found"]');
  const howFoundOther = document.getElementById("how_found_other");

  // عناصر برای نمایش/مخفی کردن ساعت 14:30-16 تنها برای A1
  const germanLevelParticipateRadios = document.querySelectorAll(
    'input[name="german_level_participate"]'
  );
  const a1OnlyTime = document.getElementById("a1-only-time");

  // نمایش/مخفی کردن فیلد Other برای سطح آلمانی
  germanLevelRadios.forEach((radio) => {
    radio.addEventListener("change", function () {
      if (this.value === "other" && this.checked) {
        germanLevelOther.style.display = "block";
        germanLevelOther.querySelector("input").focus();
      } else {
        germanLevelOther.style.display = "none";
        germanLevelOther.querySelector("input").value = "";
      }
    });
  });

  // نمایش/مخفی کردن ساعت 14:30-16 تنها برای A1
  germanLevelParticipateRadios.forEach((radio) => {
    radio.addEventListener("change", function () {
      if (this.value === "A1" && this.checked) {
        a1OnlyTime.style.display = "block";
      } else {
        a1OnlyTime.style.display = "none";
        // اگر این checkbox انتخاب شده بود، خارج کن
        const a1Checkbox = a1OnlyTime.querySelector(
          'input[name="preferred_times[]"]'
        );
        if (a1Checkbox) {
          a1Checkbox.checked = false;
        }
      }
    });
  });

  // نمایش/مخفی کردن فیلد Other برای کتاب‌ها
  booksCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      if (this.value === "other" && this.checked) {
        booksOther.style.display = "block";
        booksOther.querySelector("input").focus();
      } else if (
        !document.querySelector('input[name="books[]"][value="other"]:checked')
      ) {
        booksOther.style.display = "none";
        booksOther.querySelector("input").value = "";
      }
    });
  });

  // نمایش/مخفی کردن فیلد Other برای چطور آشنا شدید
  howFoundRadios.forEach((radio) => {
    radio.addEventListener("change", function () {
      if (this.value === "other" && this.checked) {
        howFoundOther.style.display = "block";
        howFoundOther.querySelector("input").focus();
      } else {
        howFoundOther.style.display = "none";
        howFoundOther.querySelector("input").value = "";
      }
    });
  });

  // Validation هنگام سابمیت
  form.addEventListener("submit", function (e) {
    let errors = [];

    // 1. ایمیل
    const email = document.getElementById("email").value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
      errors.push("ایمیل الزامی است.");
    } else if (!emailRegex.test(email)) {
      errors.push("فرمت ایمیل صحیح نیست.");
    }

    // 2. فیلدهای متنی اجباری
    const requiredTexts = [
      "full_name",
      "telegram_id",
      "nationality",
      "country",
    ];
    requiredTexts.forEach((id) => {
      if (!document.getElementById(id).value.trim()) {
        errors.push(getLabelText(id) + " الزامی است.");
      }
    });

    // 3. حداقل یک ساعت مناسب
    const timesChecked = document.querySelectorAll(
      'input[name="preferred_times[]"]:checked'
    );
    if (timesChecked.length === 0) {
      errors.push("حداقل یک ساعت مناسب انتخاب کنید.");
    }

    // 4. حداقل یک کتاب (یا هیچ کدام یا سایر)
    const booksChecked = document.querySelectorAll(
      'input[name="books[]"]:checked'
    );
    if (booksChecked.length === 0) {
      errors.push("حداقل یک گزینه از کتاب‌ها انتخاب کنید.");
    }

    // 5. قوانین
    if (!document.querySelector('input[name="rules_agreed"]:checked')) {
      errors.push("برای ادامه باید با قوانین موافق باشید.");
    }

    // اگر خطایی بود، جلوگیری از سابمیت و نمایش پیام
    if (errors.length > 0) {
      e.preventDefault();
      alert("لطفاً خطاهای زیر را برطرف کنید:\n\n• " + errors.join("\n• "));
    }
  });

  // تابع کمکی برای گرفتن متن لیبل
  function getLabelText(id) {
    const label = document.querySelector(`label[for="${id}"]`);
    return label ? label.textContent.replace(" *", "") : id;
  }
});
